<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserInvoice;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\RefOrder;
use App\Models\User;
use App\Models\Wallet;
use App\Services\zarinPal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index()
    {
        $order = Order::where('buyer_id', Auth::id())->pending()->with('items')->first();
        $orderItems = $order->items ?? null;
        if ($orderItems) {
            $orderItems->map(function ($item) {
                $image_url = $item->product->getFirstMedia()->getUrl();
                $item->product->image_url = $image_url;
            });

            $subtotal = 0;
            foreach ($orderItems as $key => $item) {
                $subtotal += $item->qty * $item->product->default_price;
            }
        }

        $userAddress = Auth::user()->address->first();
        $wallet = Auth::user()->wallet;

        return Inertia::render('Store/Cart', [
            'order' => $order ?? null,
            'subtotal' => $subtotal ?? null,
            'userAddress' => $userAddress ?? null,
            'wallet' => $wallet ?? null
        ]);
    }

    public function orderDetails(Order $order)
    {
        $order->load('items', 'items.product');

        $order->map(function ($order) {
            $order->items->map(function ($item) {
                $image_url = $item->product->getFirstMedia()->getUrl();
                $item->product->image_url = $image_url;
            });
        });

        return Inertia::render('Store/OrderShow', [
            'order' => $order
        ]);
    }

    public function addToCart(Request $request)
    {
        $order = Order::firstOrCreate(
            ['buyer_id' => Auth::id()],
            ['status' => 'pending']
        );

        $product = Product::find($request->product_id);

        $found_in_cart = OrderItem::isInCart(
            $request->product_id,
            $request->picked_color,
            $request->picked_size,
        )
            ->first();

        if (!empty($found_in_cart)) {
            OrderItem::where('id', $found_in_cart->id)->increment('qty');
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'picked_color' => $request->picked_color,
                'picked_size' => $request->picked_size,
                'qty' => 1,
                'buyer_id' => Auth::id(),
                'status' => 'pending'
            ]);
        }

        return response()->json([
            'message' => 'Order registered',
        ]);
    }

    public function switchToSaveForLater()
    {
    }
    public function increaseOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPurchase()->increment('qty');
    }

    public function decreaseOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPurchase()->decrement('qty');
    }

    public function deleteOrder($id)
    {
        OrderItem::where('product_id', $id)->pendingPurchase()->delete();
    }

    public function countOrders(Product $product)
    {
        return  OrderItem::pendingPurchase()->count();
    }


    public function finalizeOrder(Request $request, Order $order)
    {
        Validator::make($request->all(), [
            'recipient_name' => 'required_if:use_default_address,false',
            'mobile' => 'required_if:use_default_address,false',
            'address' => 'required_if:use_default_address,false',
            'zipcode' => 'required_if:use_default_address,false',
            'save_address_as_default ' => 'boolean',
            'use_default_address' => 'boolean',
            'useWallet' => 'boolean|required',
        ], [
            'recipient_name.required' => 'fill in name field please',
            'mobile.required' => 'fill in mobile field please',
            'address.required' => 'fill in address field please',
            'zipcode.required' => 'fill in zipcode field please',
        ])->validate();


        try {
            DB::beginTransaction();
            if ($request->use_default_address) {

                $user = User::find(Auth::id());

                $userAddress = $user->address;
                $orderAddress = $userAddress->replicate();
                $orderAddress->addressable_id = $order->id;
                $orderAddress->addressable_type = 'App\Models\Order';
                $orderAddress->save();
            } else if ($request->save_address_as_default) {

                $user = User::find(Auth::id());

                $userAddress = Address::updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'text' => $request->address,
                        'zipcode' => $request->zipcode,
                        'user_id' => $user->id,
                        'recipient_name' => $request->recipient_name,
                        'mobile' => $request->mobile,
                    ]
                );

                $orderAddress = $userAddress->replicate();
                $orderAddress->addressable_id = $order->id;
                $orderAddress->addressable_type = 'App\Models\Order';
                $orderAddress->save();
            } else {
                $order->address()->create([
                    'text' => $request->address,
                    'zipcode' => $request->zipcode,
                    'user_id' => Auth::id(),
                    'recipient_name' => $request->recipient_name,
                    'mobile' => $request->mobile,
                ]);
            }

            $order->load('items');

            $billing_subtotal = 0;
            foreach ($order->items as $key => $orderItem) {
                $billing_subtotal += $orderItem->qty * $orderItem->product->default_price;
            }

            $billing_tax = 9 / 100 * $billing_subtotal;
            $billing_total = $billing_tax + $billing_subtotal;

            $delivery_cost = env('DELIRVERY_COST', 18);
            if ($billing_total >= 700) {
                $delivery_cost = 0;
            }

            if ($request->useWallet) {
                $wallet = Wallet::firstWhere('user_id', Auth::id());

                $balance = $wallet->balance;

                if ($balance <= $billing_total) {
                    return redirect()->back()
                        ->withErrors('insufficient inventory')
                        ->withInput();
                }
                Wallet::where('user_id', Auth::id())->decrement('balance', $billing_total);
            } else {

                $this->zarinpalPay($order);
            }

            $subtotal = 0;
            foreach ($order->items as $key => $orderItem) {

                $product = Product::FirstWhere('id', $orderItem->product_id);
                $product->increment('sold_qty', $orderItem->qty);

                $billing_total = ($orderItem->qty * $product->default_price) + (9 / 100 * ($orderItem->qty * $product->default_price));

                $subtotal += $billing_total;
                $orderItem->update([
                    'billing_total' => $billing_total,
                ]);
            }

            // SendUserInvoice::dispatch();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return response()->json([
                'error' => 'sth went wrong'
            ], 422);
        }


        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }


    public function zarinpalPay(Order $order)
    {
        $payment = Payment::create([
            'order_id' => $order->id,
            'bank' => 'zarinpal',
        ]);

        $zarinpal = new zarinPal([
            'merchantId' => '12369874156985214563258745632555'
        ]);

        try {
            $request = $zarinpal->apiRequest([
                'callbackurl' => 'http://localhost:8000/order/' . $order->id . '/details',
                // if the currency is Rial strike 10   total *10
                'amount' => 'paying for order by id :' . $order->id,
                'description' => $order->billing_total,
                'mobile' => $order->buyer()->mobile ?? null,
                'email' => $order->buyer()->email ?? null,
            ]);

            $payment->request_info = $request;
            $payment->save();

            $decodedRequest = json_decode($request);

            return redirect()->intended($decodedRequest->url);
        } catch (\Throwable $th) {
            var_dump(json_decode($th->getMessage()));
        }
    }
}

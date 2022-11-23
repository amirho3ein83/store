<?php

namespace App\Http\Controllers;

use App\Jobs\SendUserInvoice;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\RefOrder;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index(Product $product)
    {
        $orderItems = OrderItem::with('product')->get();

        $orderItems->map(function ($order) {
            $image_url = $order->product->getFirstMedia()->getUrl();
            $order->product->image_url = $image_url;
        });

        $subtotal = 0;
        foreach ($orderItems as $key => $item) {
            $subtotal += $item->qty * $item->product->default_price;
        }
        $userAddress = Auth::user()->addresses->first();
        $wallet = Auth::user()->wallet;

        return Inertia::render('Store/Cart', [
            'orderItems' => $orderItems,
            'subtotal' => $subtotal,
            'userAddress' => $userAddress ?? null,
            'wallet' => $wallet ?? null
        ]);
    }

    public function addToCart(Request $request)
    {

        // try {
        // DB::beginTransaction();

        $product = Product::find($request->product_id);

        $found_in_cart = OrderItem::isInCart(
            $request->product_id,
            $request->picked_color,
            $request->picked_size,
        )
            ->first();

        if (!empty($found_in_cart)) {
            $cart =  OrderItem::where('id', $found_in_cart->id)->increment('qty');
        } else {
            $cart = OrderItem::create([
                'product_id' => $product->id,
                'picked_color' => $request->picked_color,
                'picked_size' => $request->picked_size,
                'qty' => 1,
                'buyer_id' => Auth::id(),
                'status' => 'pending'
            ]);
        }

        //     DB::commit();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     info($e);
        //     return Response::json(['error' => $e], 422);
        // }

        // if ($cart) {
        return response()->json([
            'message' => 'Order registered',
        ]);
        // }
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


    public function registerOrder(Request $request)
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

                $userDefaultAddress =  User::whereId(Auth::id())->with(['addresses' => function ($query) {
                    $query->where('is_default', true);
                }])->first();

                $userDefaultAddress = $userDefaultAddress->addresses;
            } else if ($request->save_address_as_default) {

                $userDefaultAddress =  User::whereId(Auth::id())->with(['addresses' => function ($query) {
                    $query->where('is_default', true)->update(['is_default' => false]);
                }]);

                $user = User::find(2);
                $user_address = $user->addresses()->create([
                    'text' => $request->address,
                    'zipcode' => $request->zipcode,
                    'user_id' => $user->id,
                    'recipient_name' => $request->recipient_name,
                    'mobile' => $request->mobile,
                    'is_default' => true,
                ]);
            }
            //  else {
            //     $reforder->address()->create([
            //         'text' => $request->address,
            //         'zipcode' => $request->zipcode,
            //         'user_id' => Auth::id(),
            //         'recipient_name' => $request->recipient_name,
            //         'mobile' => $request->mobile,
            //     ]);
            // }








            $orders = Order::with('product')->pendingPurchase()->get();

            $billing_subtotal = 0;
            foreach ($orders as $key => $order) {
                $billing_subtotal += $order->qty * $order->product->default_price;
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
            }

            $subtotal = 0;
            foreach ($orders as $key => $order) {

                $product = Product::FirstWhere('id', $order->product_id);
                $product->increment('sold_qty', $order->qty);

                $billing_total = ($order->qty * $product->default_price) + (9 / 100 * ($order->qty * $product->default_price));

                $subtotal += $billing_total;
                $order->update([
                    'billing_subtotal' => $billing_subtotal,
                    'billing_tax' => $billing_tax,
                    'billing_total' => $billing_total,
                ]);
            }

            $order = Order::create([
                'status' => 'completed',
                'billing_subtotal' => $billing_subtotal,
                'billing_tax' => $billing_tax,
                'billing_total' => $billing_total,
                'delivery_cost' => $delivery_cost,
                'no_of_items' => $orders->count(),
                'buyer_id' => Auth::id()
            ]);
            // SendUserInvoice::dispatch();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
            return redirect()->back()
                ->withErrors($e->getMessage())
                ->withInput();
        }


        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{

    public function index(Product $product)
    {
        $orders = Order::with('product')->pendingPurchase()->get();

        $subtotal = 0;
        foreach ($orders as $key => $order) {
            $subtotal += $order->qty * $order->product->sale_price;
        }
        $user_address = Auth::user()->address;
        $wallet = Auth::user()->wallet;

        return Inertia::render('Store/Cart', [
            'orders' => $orders,
            'subtotal' => $subtotal,
            'user_address' => $user_address ?? null,
            'wallet' => $wallet ?? null
        ]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $productFoundInCart = Order::where('product_id', $request->product_id)->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            $cart = Order::create([
                'product_id' => $product->id,
                'price' => $product->price,
                'qty' => 1,
                'user_id' => Auth::id(),
                'status' => 'pending_purchase'
            ]);
        } else {
            $cart =  Order::where('product_id', $product->id)->increment('qty');
        }


        if ($cart) {
            return [
                'message' => 'Order registered',
            ];
        }
    }

    public function increaseOrder($id)
    {
        Order::where('product_id', $id)->pendingPurchase()->increment('qty');
    }

    public function decreaseOrder($id)
    {
        Order::where('product_id', $id)->pendingPurchase()->decrement('qty');
    }

    public function deleteOrder($id)
    {
        Order::where('product_id', $id)->pendingPurchase()->delete();
    }

    public function countOrders(Product $product)
    {
        return  Order::pendingPurchase()->count();
    }


    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'recipient_name' => 'nullable',
            'mobile' => 'nullable|numeric',
            'subtotal' => 'required|numeric',
            'address' => 'nullable',
            'card_number' => 'nullable|numeric|digits:16',
            'expirationYear' => 'nullable',
            'expirationMonth' => 'nullable',
            'cvc' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        // Retrieve the validated input...
        $validated = $validator->validated();


        $delivery_cost = env('DELIRVERY_COST');
        // check subtotal for free delivery
        if ($request->subtotal >= 500) {
            $delivery_cost = 0;
        }

        // add tax 
        $after_tax = $request->subtotal / 100 * 9;


        DB::beginTransaction();

        try {

            if ($request->save_address) {
                Address::create([
                    'text' => $validated['address'],
                    'recipient_name' => $validated['recipient_name'],
                    'user_id' => Auth::id(),
                    'postal_code' => $validated['postal_code'],
                    'mobile' => $validated['mobile']
                ]);
            } else {
                // use defaul address
            }

            if ($request->paymentMethod == 'wallet') {
                $wallet = Wallet::firstWhere('user_id', Auth::id());

                $stock = $wallet->stock;
                info('walllllllet');

                if ($stock < $after_tax) {
                    return redirect()->back()
                        ->withErrors('insufficient inventory')
                        ->withInput();
                }
                Wallet::where('user_id', Auth::id())->decrement('stock', $after_tax);
            }
            $orders = Order::where('user_id', Auth::id())->get();

            foreach ($orders as $key => $order) {
                $product = Product::where('id', $order->product_id);
                $product->increment('sold_qty', $order->qty);
                $order->update(['status' => 'purchased']);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }


        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }
}

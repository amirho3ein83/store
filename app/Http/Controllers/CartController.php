<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CartController extends Controller
{

    public function index(Product $product)
    {
        $cart = Order::with('product')->where('user_id', Auth::id())->get();

        // info($cart);
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        $total = 0;

        foreach ($cart as $key => $item) {
            $total += $item->price *  $item->quantity;
        }

        $cart->total = $total;

        return Inertia::render('Store/PaymentSteps/OrderList', ['cart' => $cart, 'total' => $total]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $productFoundInCart = Order::where('product_id', $request->product_id)->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            $cart = Order::create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'user_id' => Auth::id()
            ]);
        } else {
            $cart =  Order::where('product_id', $product->id)->increment('quantity');
        }


        if ($cart) {
            return [
                'message' => 'Order updated',
            ];
        }
    }

    public function increaseOrder($id)
    {
        Order::firstWhere([['user_id', Auth::id()], ['product_id', $id]])->increment('quantity');
    }
    public function decreaseOrder($id)
    {
        Order::firstWhere([['user_id', Auth::id()], ['product_id', $id]])->decrement('quantity');
    }
    public function deleteOrder($id)
    {
        Order::where([['user_id', Auth::id()], ['product_id', $id]])->delete();
    }

    public function countOrders(Product $product)
    {
        return  Order::where('user_id', Auth::id())->count();
    }


    public function payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'recipient_name' => 'required',
            'mobile' => 'required|numeric|digits:10',
            'subtotal' => 'required|numeric',
            'address' => 'required',
            'card_number' => 'numeric|digits:16',
            'expirationYear' => 'numeric|digits:4',
            'expirationMonth' => 'numeric|digits:2',
            'cvc' => 'number',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Retrieve the validated input...
        $validated = $validator->validated();


















        // check subtotal for free delivery
        // add tax 


        if ($request->saveInfo) {
            Address::create([
                'text' => $validated['address'],
                'recipient_name' => $validated['recipient_name'],
                'user_id' => Auth::id()
            ]);
        }

        //////////////////////////////////
        DB::beginTransaction();

        try {

            if ($request->paymentMethod == 'wallet') {

                $wallet = Wallet::firstWhere('user_id', Auth::id());

                $balance = $wallet->balance;

                if ($balance > $request->subtotal) {
                    return redirect()->back()
                        ->withErrors('insufficient inventory')
                        ->withInput();
                }
            }

            $orders = Order::where('user_id', Auth::id())->get();

            foreach ($orders as $key => $item) {
                Product::where('id', $item->product->id)->increment('sold_qty', $item->qty);
            }

            $orders->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            info($e);
        }


        return response()->json([
            'message' => 'success'
        ], 200);
    }
}

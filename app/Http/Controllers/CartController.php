<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class CartController extends Controller
{

    public function index(Product $product)
    {
        $cart = CartItem::with('product')->where('user_id', Auth::id())->get();

        // info($cart);
        // foreach ($variable as $key => $value) {
        //     # code...
        // }
        $total = 0;

        foreach ($cart as $key => $item) {
            $total += $item->price *  $item->quantity;
        }

        $cart->total = $total;

        return Inertia::render('Store/Cart', ['cart' => $cart, 'total' => $total]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $productFoundInCart = CartItem::where('product_id', $request->product_id)->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            $cart = CartItem::create([
                'product_id' => $product->id,
                'price' => $product->price,
                'quantity' => 1,
                'user_id' => Auth::id()
            ]);
        } else {
            $cart =  CartItem::where('product_id', $product->id)->increment('quantity');
        }


        if ($cart) {
            return [
                'message' => 'CartItem updated',
            ];
        }
    }

    public function increaseCartItem($id)
    {
        CartItem::firstWhere([['user_id', Auth::id()], ['product_id', $id]])->increment('quantity');
    }
    public function decreaseCartItem($id)
    {
        CartItem::firstWhere([['user_id', Auth::id()], ['product_id', $id]])->decrement('quantity');
    }
    public function deleteCartItem($id)
    {
        CartItem::where([['user_id', Auth::id()], ['product_id', $id]])->delete();
    }

    public function countCartItems(Product $product)
    {
        return  CartItem::where('user_id', Auth::id())->count();
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
                'user_id' => Auth::id()
            ]);
        }



        if ($request->paymentMethod == 'wallet') {

            $wallet = Wallet::firstWhere('user_id', Auth::id());

            $balance = $wallet->balance;

            if ($balance > $request->subtotal) {
                return redirect()->back()
                    ->withErrors('insufficient inventory')
                    ->withInput();
            }
        }



        $cartItems = CartItem::where('user_id', Auth::id())->get();

        foreach ($cartItems as $key => $item) {
            Product::where('id',$item->product->id)->increment('sold_qty',$item->qty);
        }

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}

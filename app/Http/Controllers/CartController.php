<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public function payment(Product $product)
    {
        // return  CartItem::where('user_id', Auth::id())->sum('quantity');
    }
}

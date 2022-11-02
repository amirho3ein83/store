<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{

    public function index(Product $product)
    {
        $cart = Cart::with('products')->where('user_id', Auth::id())->get();

        return Inertia::render('Store/Cart', ['cart'=> $cart]);
    }

    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        $productFoundInCart = Cart::where('product_id', $request->product_id)->pluck('id');

        if ($productFoundInCart->isEmpty()) {
            $cart = Cart::create([
                'product_id' => $product->id,
                'price' => $product->sale_price,
                'quantity' => 1,
                'user_id' => Auth::id()
            ]);
        } else {
            $cart =  Cart::where('product_id', $product->id)->increment('quantity');
        }


        if ($cart) {
            return [
                'message' => 'Cart updated',
            ];
        }
    }

    public function countCartItems(Product $product)
    {
        return  Cart::where('user_id', Auth::id())->sum('quantity');
    }
}

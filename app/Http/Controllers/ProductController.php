<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{

    protected $_validation = [
        'name' => 'bail|required|unique:products|max:255',
        'description' => 'required|max:255',
        'price' => 'required | integer',
        'image' => 'required ',
    ];



    public function index(Request $request)
    {
        $amazing_offers = AmazingOffer::with('product')->get();
        return Inertia::render('Store/Products/Home', ['amazing_offers' => $amazing_offers]);
    }

    public function category(Request $request)
    {
        $categories = Category::all();

        return Inertia::render(
            'Store/Products/Category',
            ['categories' => $categories]
        );
    }
    public function productList($id)
    {
        $in_cart_products = CartItem::where('user_id', Auth::id())->pluck('id')->toArray();

        $products = Product::where('category_id', $id)->simplePaginate(20);

        $products->map(function ($product) use ($in_cart_products) {
            if (in_array($product->id, $in_cart_products)) {
                $product->is_in_cart = true;
            }
        });

        return Inertia::render(
            'Store/Products/ProductList',
            ['products' => $products]
        );
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'balance' => $request->balance
        ]);

        $product->addMediaFromRequest('image')->toMediaCollection();
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => 'bail|required|unique:products|max:255',
            'description' => 'required|max:255',
            'price' => 'required | integer',
            'image' => 'required ',
        ]);


        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // $product->removeMedia();
        $product->addMediaFromRequest('image')->toMediaCollection();
    }


    public function edit(Product $product)
    {
        return Inertia::render('Store/Product/Edit', ['product' => $product]);
    }

    public function show(Product $product)
    {
        return Inertia::render('Store/Products/Show', ['product' => $product]);
    }
}

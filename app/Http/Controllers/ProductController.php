<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
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
        return Inertia::render('Store/Products/Index', ['products' => Product::simplePaginate(10)]);
        // return Inertia::render('backoffice/Dashboard');
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

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        info($request->name);
        // dd();
        DB::transaction(function ($request) {

            $request->validate([
                'name' => 'bail|required|unique:products|max:255',
                'description' => 'required|max:255',
                'price' => 'required | integer',
                'image' => 'required ',
            ]);


            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
            ]);

            $product->addMediaFromRequest('image')->toMediaCollection();
        });
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
}

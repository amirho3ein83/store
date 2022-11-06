<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Product;
use App\Models\RecentVisit;
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
    public function productList($id, Request $request)
    {



        $products = Product::query()
            ->where('category_id', $id)
            ->when($request->search, function ($query, $search) {
                $query->where('slug', 'like', "%{$search}%");
            })
            ->when($request->order_by, function ($query, $order_by) {
                switch ($order_by) {
                    case 'newest':
                        $query->latest();
                        break;
                    case 'cheapest':
                        $query->orderBy('price');
                        break;
                    case 'most_expensive':
                        $query->orderBy('price', 'DESC');
                        break;
                    case 'bsetselling':
                        $query->orderBy('sold_qty', 'DESC');
                        break;
                }
            })
            ->simplePaginate(5)
            ->withQueryString();

        $in_cart_products = CartItem::where('user_id', Auth::id())->pluck('id')->toArray();


        $products->map(function ($product) use ($in_cart_products) {
            if (in_array($product->id, $in_cart_products)) {
                $product->is_in_cart = true;
            }
        });

        return Inertia::render(
            'Store/Products/ProductList',
            [
                'products' => $products,
                'filters' => $request->get('search', 'order_by')
            ]
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
        RecentVisit::create([]);
        return Inertia::render('Store/Products/Show', ['product' => $product]);
    }
}

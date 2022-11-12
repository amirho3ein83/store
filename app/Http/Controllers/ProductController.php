<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\RecentVisit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ProductController extends Controller
{

    protected $_validation = [
        'title' => 'bail|required|unique:products|max:255',
        'description' => 'required|max:255',
        'price' => 'required | integer',
        'image' => 'required ',
    ];



    public function index(Request $request)
    {
        $amazing_offers = AmazingOffer::with('product')->get();
        return Inertia::render('Store/Products/Home', ['amazing_offers' => $amazing_offers]);
    }
    public function create(Request $request)
    {
        $categories = Category::all();

        return Inertia::render('Admin/Products/Create', ['categories' => $categories]);
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
                    case 'rate':
                        $query->orderBy('rate', 'DESC');
                        break;
                    case 'most_visited':
                        $query->orderBy('reviews', 'DESC');
                        break;
                }
            })
            ->simplePaginate(15)
            ->withQueryString();

        // $in_cart_products = Order::where('user_id', Auth::id())->with('product:id')->pluck('id')->toArray();
        $in_cart_products = Order::with('product:id')->get()->pluck('product.id')->toArray();

        $products->map(function ($product) use ($in_cart_products) {
            if (in_array($product->id, $in_cart_products)) {
                $product->is_in_cart = true;
            }
        });

        return Inertia::render(
            'Store/Products/ProductList',
            [
                'products' => $products,
            ]
        );
    }

    public function store(Request $request)
    {

        $product = Product::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'balance' => $request->balance,
            'category_id' => $request->category_id
        ]);

        $product->sizes->attach($request->sizes);
        $product->colors->attach($request->colors);
        // for availalfm;dsa
        // $post->comments()->save($request->size);

        // foreach ($request->tags as $id)
        //     $tags[] = Tag::find($id);

        // $post = Post::find($id);
        // $post->tags()->saveMany($tags);

        $product->addMediaFromRequest('image')->toMediaCollection();
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'title' => 'bail|required|unique:products|max:255',
            'description' => 'required|max:255',
            'price' => 'required | integer',
            'image' => 'required ',
        ]);


        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // $product->removeMedia();
        $product->addMediaFromRequest('image')->toMediaCollection();
    }

    public function likeProduct($id)
    {
        $user = User::find(Auth::id());

        $user->likedproducts()->attach($id);
    }

    public function unlikeProduct($id)
    {
        $user = User::find(Auth::id());

        $user->likedproducts()->detach($id);
    }

    public function rateProduct(Request $request)
    {
        Rating::create([
            'user_id' => Auth::id(),
            'stars_rated' => $request->stars_count,
            'product_id' => $request->product_id,
        ]);
    }


    public function edit(Product $product)
    {
        $categories = Category::all();

        return Inertia::render('Admin/Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    public function show(Product $product)
    {

        // check if user already liked the product
        $liked_by_user = DB::table('liked_products')->where([['liked_by', Auth::id()], ['product_id', $product->id]])->get();
        if ($liked_by_user->isNotEmpty()) {
            $product->is_liked = true;
        }

        if (Order::where([['user_id', Auth::id()], ['product_id', $product->id]])->exists()) {
            $product->is_in_cart = true;
        }

        return Inertia::render('Store/Products/Show', ['product' => $product]);
    }
}

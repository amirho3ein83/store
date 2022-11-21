<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\RecentVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{

    protected $_validation = [
        'title' => 'bail|required|unique:products|max:255',
        'description' => 'required|max:255',
        'price' => 'required | integer',
        'image' => 'required ',
    ];



    public function homePage(Request $request)
    {
        $amazing_offers = AmazingOffer::where('expiry_date', '>', Carbon::now())->inRandomOrder()->with('product')->get();

        $amazing_offers->map(function ($amazing_offer) {
            $image_url = $amazing_offer->product->getFirstMedia()->getUrl();
            $amazing_offer->product->image_url = $image_url;
        });

        $categories = Category::all();

        return Inertia::render('Store/LandingPage', ['amazing_offers' => $amazing_offers, 'categories' => $categories]);
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
            ->whereHas('categories', function ($query) use ($id) {
                $query->where('categories.id', $id);
            })
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
            ->with('brand', 'attributes', 'attributes.qty')
            ->simplePaginate(15)
            ->withQueryString();

        $in_cart_products = Order::with('product:id')->get()->pluck('product.id')->toArray();

        $products->map(function ($product) use ($in_cart_products) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
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
            'stock' => $request->stock,
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
    }


    public function edit(Product $product)
    {
        $categories = Category::all();

        return Inertia::render('Admin/Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    public function show($slug)
    {

        $product = Product::where('slug', $slug)
            ->with('brand', 'attributes', 'attributes.qty')
            ->firstOrFail();

        $product->increment('reviews');

        // check if user already liked the product
        $liked_by_user = DB::table('liked_products')->where([['liked_by', Auth::id()], ['product_id', $product->id]])->get();
        if ($liked_by_user->isNotEmpty()) {
            $product->is_liked = true;
        }

        // check if user already save product in cart
        // if (Order::where([['buyer_id', Auth::id()], ['product_id', $product->id]])->exists()) {
        //     $product->is_in_cart = true;
        // }

        // load images
        $image_url = $product->getFirstMedia()->getUrl();
        $product->image_url = $image_url;


        // $product->load('brand', 'availableColors', 'availableSizes');
        $product->load('brand');

        // $similar_products = Product::where('category_id', $product->category_id)->inRandomOrder()->take(4)->get();
        // $similar_products->map(function ($product) {
        //     $image_url = $product->getFirstMedia()->getUrl();
        //     $product->image_url = $image_url;
        // });



        return Inertia::render('Store/Products/Show', ['product' => $product]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\Order;
use App\Models\Category;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Rating;
use App\Models\RecentVisit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductController extends Controller
{

    protected $_validation =             [
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'details' => 'required|max:255',
        'default_price' => 'required|between:1000,200000000|numeric',
        'picked_categories' => 'required|array',
        'product_attributes' => 'required|array',
        'colors' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

    ];

    protected $_validationMessages = [
        'title.required' => ' نام لازم است',
        'description.required' => ' موبایل مورد نیاز است',
        'details.required' => ' آدرس مورد نیاز است',
        'default_price.required' => ' قیمت  لازم است',
        'default_price.between' => ' حداقل قیمت باید ۱۰۰۰ تومان باشد',
        'picked_categories.required' => ' دسته بندی  لازم است',
        'product_attributes.required' => '  گروه بندی لازم است',
        'image.required' => ' عکس  لازم است',
        'image.mimes' => "فرمت عکس باید png jpg jpeg باشد",
    ];



    public function homePage()
    {
        $amazing_offers = AmazingOffer::where('expiry_date', '<', Carbon::now())->inRandomOrder()->with('product')->get();

        $amazing_offers->map(function ($amazing_offer) {
            $image_url = $amazing_offer->product->getFirstMedia()->getUrl();
            $amazing_offer->product->image_url = $image_url;
        });

        $categories = Category::all();

        return Inertia::render('Store/LandingPage', ['amazing_offers' => $amazing_offers, 'categories' => $categories]);
    }


    public function show($slug)
    {

        $product = Product::where('slug', $slug)
            ->with(['availableColors', 'attributes', 'comments'])
            ->firstOrFail();

        $product->increment('reviews');

        // check if user already liked the product
        $liked_by_user = DB::table('liked_products')->where([['liked_by', Auth::id()], ['product_id', $product->id]])->get();
        if ($liked_by_user->isNotEmpty()) {
            $product->is_liked = true;
        }

        // check if user already save product in cart
        if (OrderItem::where([['buyer_id', Auth::id()], ['product_id', $product->id]])->exists()) {
            $product->is_in_cart = true;
        }

        // load images
        $image_url = $product->getFirstMedia()->getUrl();
        $product->image_url = $image_url;

        $similar_products = Product::where('sku', $product->sku)->inRandomOrder()->take(5)->get();

        $similar_products->map(function ($product) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
        });

        $product->comments->map(function ($comment) {
            if ($comment->author->hasMedia()) {
                $image_url = $comment->author->getFirstMedia()->getUrl();
                $comment->author->image_url = $image_url;
            } else {
                $comment->author->image_url = null;
            }
        });


        return Inertia::render('Store/Products/Show', ['product' => $product, 'similar_products' => $similar_products]);
    }


    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();

        return Inertia::render(
            'Admin/Products/Create',
            [
                'categories' => $categories,
                'colors' => $colors,
            ]
        );
    }

    public function category()
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
                        $query->orderBy('default_price');
                        break;
                    case 'most_expensive':
                        $query->orderBy('default_price', 'DESC');
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

        $in_cart_products = OrderItem::with('product:id')->get()->pluck('product.id')->toArray();

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
        Validator::make(
            $request->all(),
            $this->_validation,
            $this->_validationMessages,
        )->validate();

        DB::transaction(function () use ($request) {

            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'details' => $request->details,
                'default_price' => $request->default_price,
                'stock' => 0
            ]);

            $product->categories()->attach($request->picked_categories);

            // set price groups depends on color
            $productQty = 0;

            foreach ($request->colors as $key => $pr) {
                $product->availableColors()->attach($pr['color']['id'], ['price' => $pr['price'], 'stock' => $pr['stock']]);
                $productQty += $pr['stock'];
            }
            // set total stock of product
            $product->update([
                'stock' => $productQty
            ]);

            // set attributes
            foreach ($request->product_attributes as $key => $attr) {
                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'title' => $attr['title'],
                    'value' => $attr['value'],
                ]);
            }


            $product->addMediaFromRequest('image')->toMediaCollection();
        });
    }

    public function update(Product $product, Request $request)
    {



        // info($request->colors);
        // dd();
        $this->_validation['image'] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048';
        Validator::make(
            $request->all(),
            $this->_validation,
            $this->_validationMessages,
        )->validate();

        DB::transaction(function () use ($request, $product) {

            $product->update([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'details' => $request->details,
                'default_price' => $request->default_price,
                'stock' => 0
            ]);

            $product->categories()->detach();
            $product->categories()->attach($request->picked_categories);

            // set price groups depends on color
            $productQty = 0;

            $product->availableColors()->delete();
            foreach ($request->colors as $key => $pr) {
                $product->availableColors()->attach($pr['id'], ['price' => $pr['pivot']['price'], 'stock' => $pr['pivot']['stock']]);
                $productQty += $pr['pivot']['stock'];
            }
            // set total stock of product
            $product->update([
                'stock' => $productQty
            ]);

            // set attributes
            foreach ($request->product_attributes as $key => $attr) {
                $productAttribute = ProductAttribute::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'title' => $attr['title'],
                    ],
                    [
                        'value' => $attr['value'],
                    ]
                );
            }

            $product->getFirstMedia()->delete();
            $product->addMediaFromRequest('image')->toMediaCollection();
        });
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


    public function edit($id)
    {
        $product = Product::whereId($id)->with('categories', 'availableColors', 'attributes')->first();

        // load images
        $image_url = $product->getFirstMedia()->getUrl();
        $product->image_url = $image_url;


        $categories = Category::all();
        $colors = Color::all();

        return Inertia::render('Admin/Products/Edit', [
            'product' => $product,
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }
}

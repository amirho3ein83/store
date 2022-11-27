<?php

namespace App\Http\Controllers;

use App\Models\AmazingOffer;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Category;
use App\Models\Color;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeQty;
use App\Models\Rating;
use App\Models\RecentVisit;
use App\Models\Size;
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
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();

        return Inertia::render(
            'Admin/Products/Create',
            [
                'categories' => $categories,
                'sizes' => $sizes,
                'colors' => $colors,
                'brands' => $brands,
            ]
        );
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

        $in_cart_products = OrderItem::with('product:id')->get()->pluck('product.id')->toArray();

        $products->map(function ($product) use ($in_cart_products) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
            // $product->getRawOriginal('default_price') = convertToPersianNumber($product->getRawOriginal('default_price'));
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
            [
                'title' => 'required',
                'description' => 'required',
                'details' => 'required',
                'default_price' => 'required|numeric',
                'brand_id' => 'required|numeric',
                'category_ids' => 'required|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            ]
        )->validate();
        // dd('done');

        DB::transaction(function () use ($request) {

            $product = Product::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'description' => $request->description,
                'details' => $request->details,
                'brand_id' => $request->brand_id,
                'default_price' => $request->default_price,
            ]);

            $product->categories()->attach($request->category_ids);

            $productQty = 0;

            foreach ($request->attribute_groups as $key => $attributeGroup) {


                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'size' => $attributeGroup->size,
                    'color' => $attributeGroup->color,
                    'price' => $attributeGroup->price

                ]);

                $productAttributeQty = ProductAttributeQty::create([
                    'qty' => rand(5, 50),
                    'product_attribute_id' => $productAttribute->id
                ]);

                $productQty += $productAttributeQty->qty;
            }

            $product->update([
                'stock' => $productQty
            ]);

            $product->addMediaFromRequest('image')->toMediaCollection();
        });
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
            ->with('brand', 'attributes', 'attributes.qty', 'attributes.size', 'attributes.color')
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

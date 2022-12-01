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
        'brand' => 'required',
        'picked_categories' => 'required',
        'product_attributes' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

    ];

    protected $_validationMessages = [
        'title.required' => ' نام لازم است',
        'description.required' => ' موبایل مورد نیاز است',
        'details.required' => ' آدرس مورد نیاز است',
        'brand.required' => ' برند  لازم است',
        'default_price.required' => ' قیمت  لازم است',
        'default_price.between' => ' حداقل قیمت باید ۱۰۰۰ تومان باشد',
        'picked_categories.required' => ' دسته بندی  لازم است',
        'product_attributes.required' => '  گروه بندی لازم است',
        'image.required' => ' عکس  لازم است',
        'image.mimes' => "فرمت عکس باید png jpg jpeg باشد",
    ];



    public function homePage(Request $request)
    {
        $amazing_offers = AmazingOffer::where('expiry_date', '<', Carbon::now())->inRandomOrder()->with('product')->get();

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
        $colors = Color::all();

        return Inertia::render(
            'Admin/Products/Create',
            [
                'categories' => $categories,
                'colors' => $colors,
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


        // info($request->product_attributes);
        // dd();
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
                'brand_id' => $request->brand['id'],
                'default_price' => $request->default_price,
                'stock' => 0
            ]);

            $product->categories()->attach($request->picked_categories);

            $productQty = 0;

            foreach ($request->product_attributes as $key => $attr) {
                $productAttribute = ProductAttribute::create([
                    'product_id' => $product->id,
                    'size_id' => $attr['size']['id'] ?? null,
                    'color_id' => $attr['color']['id'],
                    'price' => $attr['price']
                ]);
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
        dd();
        $categories = Category::all();

        return Inertia::render('Admin/Products/Edit', ['product' => $product, 'categories' => $categories]);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function show($slug)
    {

        $product = Product::where('slug', $slug)
            ->with([
                'brand',
                'attributes',
                'attributes.quantity',
                'attributes.size:name,id',
                'attributes.color:en_name,id,fa_name'
            ])

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


        $product->load('brand');

        // $similar_products = Product::where('category_id', $product->category_id)->inRandomOrder()->take(4)->get();
        // $similar_products->map(function ($product) {
        //     $image_url = $product->getFirstMedia()->getUrl();
        //     $product->image_url = $image_url;
        // });



        return Inertia::render('Store/Products/Show', ['product' => $product]);
    }
}

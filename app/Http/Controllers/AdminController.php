<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criticism;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminController extends Controller
{

    public function dashboard(Request $request)
    {
        $statistics = Cache::remember('users', 60 * 60 * 5, function () {

            $totalSalesToday = Transaction::where('created_at', '>=', Carbon::today())->sum('amount');
            $countTodayOrders = Order::where('created_at', '>=', Carbon::today())->count();

            return [
                'totalSalesToday' => $totalSalesToday,
                'countTodayOrders' => $countTodayOrders
            ];
        });

        $totalSalesToday = convertToPersianNumber(number_format($statistics['totalSalesToday']));
        $countTodayOrders = convertToPersianNumber(number_format($statistics['countTodayOrders']));

        return Inertia::render(
            'Admin/Dashboard',
            [
                'totalSalesToday' => $totalSalesToday,
                'countTodayOrders' => $countTodayOrders,
            ]
        );
    }

    public function productsList(Request $request)
    {

        $categoryId = $request->category_id;

        $products = Product::query()
            ->whereHas('category', function ($query) use ($categoryId, $request) {
                $query->when($request->sub_category, function ($query, $sub_category) {
                    $query->where('slug', $sub_category);
                }, function ($query) use ($categoryId) {
                    return  $query->where('parent_id', $categoryId);
                });
            })
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
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
            ->simplePaginate(10)
            ->withQueryString();

        $products->map(function ($product) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
        });

        $categories = Category::with('subCategories')->whereNull('parent_id')->get();

        return Inertia::render(
            'Admin/Products',
            [
                'products' => $products,
                'categories' => $categories,
            ]
        );
    }
    public function usersList(Request $request)
    {
        $users = User::simplePaginate(10)
            ->withQueryString();

        return Inertia::render(
            'Admin/Users',
            [
                'users' => $users,
            ]
        );
    }


    public function report(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'mobile' => ['string', 'unique:users,mobile', 'regex:/(09)[0-9]{9}/'],
            'email' => ['email', 'max:255'],
            'desc' => 'required|max:255',
        ], [
            'mobile.regex' => 'Invalid mobile format',
        ])->validate();

        Criticism::create([
            'desc' => $request->desc,
            'critic_mobile' => $request->mobile,
            'critic_email' => $request->email,
            'critic_name' => $request->name,
        ]);

        return back()->with('messsage', 'success');
    }

    public function criticismList()
    {
        return Inertia::render(
            'Admin/Criticisms',
            [
                'criticisms' => Criticism::simplePaginate(),
            ]
        );
    }

    public function ordersList()
    {
        $orders = Order::with('buyer', 'address', 'transaction')->simplePaginate(20);

        return Inertia::render(
            'Admin/OrdersList',
            [
                'orders' => $orders,
            ]
        );
    }
}

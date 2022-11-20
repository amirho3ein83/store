<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function productsList(Request $request)
    {

        $products = Product::query()
            ->when($request->category_id, function ($query, $category_id) {
                $query->where('category_id', $category_id);
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
            ->with('availableColors', 'brand', 'category')
            ->simplePaginate(10)
            ->withQueryString();

        $products->map(function ($product) {
            $image_url = $product->getFirstMedia()->getUrl();
            $product->image_url = $image_url;
        });

        $categories = Category::all();

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
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "{$search}%")
                    ->orWhere('email', 'like', "{$search}%");
            })
            ->with('roles')
            ->simplePaginate(10)
            ->withQueryString();


        return Inertia::render(
            'Admin/Users',
            [
                'users' => $users,
            ]
        );
    }
}

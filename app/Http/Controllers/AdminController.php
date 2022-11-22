<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Criticism;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function productsList(Request $request)
    {

        $products = Product::query()
            ->when($request->category_id, function ($query, $category_id) {
                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('categories.id', $category_id);
                });
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
            ->with('brand', 'categories')
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
}

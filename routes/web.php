<?php

use App\Http\Controllers\BackofficeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/','/home');
Route::get('/home', [ProductController::class, 'index'])->name('home');
Route::get('/category', [ProductController::class, 'category'])->name('category');
Route::get('/category/{id}', [ProductController::class, 'productList'])->name('product-list');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::group(['middleware' => ['role:backoffice'], 'prefix' => 'backoffice', 'name' => 'backoffice.'], function () {
        Route::get('/products-list', [BackofficeController::class, 'productsList'])->name('products.list');
    });

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/user/profile', [UserController::class,'profile'])->name('user.profile');




    Route::post('/payment', [CartController::class, 'payment'])->name('payment');

    Route::post('/cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [CartController::class, 'index'])->name('Cart');
    Route::get('/cart/count', [CartController::class, 'countCartItems'])->name('cart.count');

    Route::patch('/charge-wallet', [WalletController::class, 'increaseBalance'])->name('charge.wallet');
   
    Route::patch('/cart/products/{id}/increase-item', [CartController::class, 'increaseCartItem'])->name('cart.increase-item');
    Route::patch('/cart/products/{id}/decrease-item', [CartController::class, 'decreaseCartItem'])->name('cart.decrease-item');
    Route::delete('/cart/products/{id}', [CartController::class, 'deleteCartItem'])->name('cart.delete-item');


    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::get('/product/create', function () {
        return Inertia::render('Store/Products/Create');
    });
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});



Route::fallback(function () {
    return Inertia::render('404');
});

<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::get('/', [ProductController::class, 'index']);

    Route::post('/cart', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/cart/count', [CartController::class, 'countCartItems'])->name('cart.count');
    

    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::get('/product/create', function () {
        return Inertia::render('Store/Products/Create');
    });
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});

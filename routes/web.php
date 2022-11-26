<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;
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

Route::redirect('/', '/home');
Route::get('/home', [ProductController::class, 'homePage'])->name('home');
Route::get('/category', [ProductController::class, 'category'])->name('category');
Route::get('/category/{id}', [ProductController::class, 'productList'])->name('product-list');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/contact-us', function () {
    return Inertia::render('ContactUs');
})->name('contactus');

Route::post('/contact-us/report', [AdminController::class, 'report'])->name('contact.us.report');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // admin routes
    Route::group(['middleware' => ['role:admin'], 'prefix' => 'admin', 'name' => 'admin.'], function () {
        Route::get('/products-list', [AdminController::class, 'productsList'])->name('products.list');
        Route::get('/users-list', [AdminController::class, 'usersList'])->name('users.list');
        Route::get('/criticisms-list', [AdminController::class, 'criticismList'])->name('criticisms.list');

        Route::get('/dashboard', function () {
            return Inertia::render('Admin/Dashboard');
        })->name('admin.dashboard');
    });



    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/user/update-info', [UserController::class, 'updateInfo'])->name('user.updateInfo');

    Route::get('/user/address', [UserController::class, 'address'])->name('user.address');
    Route::get('/user/profile/wallet', [UserController::class, 'wallet'])->name('user.wallet');
    Route::get('/user/orders-list', [UserController::class, 'ordersList'])->name('user.orders.list');
    Route::get('/user/profile/liked-products', [UserController::class, 'likedProducts'])->name('user.liked.products');


    Route::post('/comment', [CommentController::class, 'storeComment'])->name('comment');
    Route::get('products/{id}/comments', [CommentController::class, 'getComments'])->name('product.comment');


    Route::post('/finalize-order/{order}', [OrderController::class, 'finalizeOrder'])->name('register.order');
    Route::post('/orders/{order}/details', [OrderController::class, 'orderDetails'])->name('order.details');

    Route::post('/cart', [OrderController::class, 'addToCart'])->name('addToCart');
    Route::get('/cart', [OrderController::class, 'index'])->name('Cart');
    Route::get('/cart/count', [OrderController::class, 'countOrders'])->name('cart.count');

    Route::get('/zarinpal-pay/{order}', [PaymentController::class, 'zarinpalPay'])->name('zarinpal.pay');
    Route::get('/zarinpal-verify/{payment}', [PaymentController::class, 'zarinpalVerify'])->name('zarinpal.verify');
    Route::get('/pay', [PaymentController::class, 'payRequest']);
    Route::get('/payment-callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');


    Route::get('/wallet-payment-request', [WalletController::class, 'walletPaymentRequest'])->name('wallet.payment.request');
    Route::get('/wallet-payment-callback', [WalletController::class, 'walletPaymentCallback'])->name('wallet.payment.callback');
    Route::get('/wallet-charge-request/{amount}', [WalletController::class, 'walletChargeRequest'])->name('wallet.charge.request');

    Route::patch('/cart/products/{id}/increase-order', [OrderController::class, 'increaseOrder'])->name('cart.increase-order');
    Route::patch('/cart/products/{id}/decrease-order', [OrderController::class, 'decreaseOrder'])->name('cart.decrease-order');
    Route::delete('/cart/products/{id}', [OrderController::class, 'deleteOrder'])->name('cart.delete-order');


    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/products/{id}/like', [ProductController::class, 'likeProduct'])->name('like-product');
    Route::patch('/products/{id}/unlike', [ProductController::class, 'unlikeProduct'])->name('unlike-product');
    Route::patch('/rate/product', [ProductController::class, 'rateProduct'])->name('rate-product');


    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});



Route::fallback(function () {
    return Inertia::render('404');
});

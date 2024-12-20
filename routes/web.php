<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');


Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginform'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/check-otp', [AuthController::class, 'checkOtp'])->name('auth.checkOtp');
    Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name('auth.resend');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout')->middleware('auth');

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('{user}', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/wishlist', [ProfileController::class, 'wishlist'])->name('wishlist');
    
    Route::get('/addresses', [ProfileController::class, 'address'])->name('address');
    Route::get('/addresses/create', [ProfileController::class, 'addressCreate'])->name('address.create');
    Route::post('/addresses', [ProfileController::class, 'addressStore'])->name('address.store');
    Route::get('/addresses/{address}/edit', [ProfileController::class, 'addressEdit'])->name('address.edit');
    Route::put('/addresses/{address}/update', [ProfileController::class, 'addressUpdate'])->name('address.update');
    Route::get('/addresses/{address}/delete', [ProfileController::class, 'addressDelete'])->name('address.delete');
    Route::get('/remove-wishlist/{wishlist}', [ProfileController::class, 'wishlistRemove'])->name('wishlist.remove');
    
    Route::get('/orders', [ProfileController::class, 'orders'])->name('profile.order');
    Route::get('/transactions', [ProfileController::class, 'transactions'])->name('profile.transaction');

});
Route::get('/add-to-wishlist', [ProfileController::class, 'wishlistAdd'])->name('wishlist.add');

Route::prefix('cart')->middleware('auth')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/increment', [CartController::class, 'increment'])->name('cart.increment');
    Route::get('/decrement', [CartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/check-coupon', [CartController::class, 'checkCoupon'])->name('cart.checkCoupon');

});


Route::prefix('payment')->middleware('auth')->group(function () {
    Route::post('/send', [PaymentController::class, 'send'])->name('payment.send');
    Route::get('/verify', [PaymentController::class, 'verify'])->name('payment.verify');
    Route::get('/status', [PaymentController::class, 'status'])->name('payment.status');
});
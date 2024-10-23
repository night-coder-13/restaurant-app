<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/menu', [MenuController::class , 'index'])->name('menu.index');
Route::get('/product/{product:slug}', [ProductController::class , 'show'])->name('product.show');

Route::get('/contact', [ContactController::class , 'index'])->name('contact');
Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');

Route::get('/login', [AuthController::class , 'loginform'])->name('auth.loginform');
Route::post('/login', [AuthController::class , 'login'])->name('auth.login');




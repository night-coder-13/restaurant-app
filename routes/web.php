<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/contact', [ContactController::class , 'index'])->name('contact');

Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');

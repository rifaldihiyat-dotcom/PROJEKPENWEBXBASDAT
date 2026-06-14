<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CheckoutController;

// Rute Halaman Utama Toko Buah (Frontend)
Route::get('/', [HomeController::class, 'index'])->name('home');
// Rute untuk Halaman Statis Pendukung
Route::view('/about', 'about')->name('about');
Route::view('/promo', 'promo')->name('promo');
Route::view('/testimoni', 'testimoni')->name('testimoni');
Route::view('/contact', 'contact')->name('contact');
Route::view('/faq', 'faq')->name('faq');
Route::view('/cara-belanja', 'cara-belanja')->name('cara-belanja');
Route::view('/keranjang', 'keranjang')->name('keranjang');

// Endpoint untuk proses checkout dari landing page
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;

// Frontend-specific routes

route::get('/',[HomeController::class,'index'])->name('home');
route::get('/about',[HomeController::class,'about'])->name('about');
route::get('/cart',[HomeController::class,'cart'])->name('cart');
route::get('/contact',[HomeController::class,'contact'])->name('contact');
route::get('/product',[HomeController::class,'product'])->name('product');
route::get('/shop',[HomeController::class,'shop'])->name('shop');
route::get('/blog',[HomeController::class,'blog'])->name('blog');


Route::post('/checkout', [HomeController::class, 'store'])->name('checkout');


// routes/web.php
Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('cart.add');
Route::get('/get-cart', [HomeController::class, 'getCart'])->name('cart.get');
Route::post('/remove-cart-item', [HomeController::class, 'removeCartItem'])->name('cart.remove');

Route::post('/update-cart-item', [HomeController::class, 'updateCartItem'])->name('cart.update');

Route::post('/check', [PaymentController::class, 'check'])->name('check');


Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');



// Route::post('/success', [PaymentController::class, 'success'])->name('success');
// Route::post('/fail', [PaymentController::class, 'fail'])->name('fail');
// Route::post('/cancel', [PaymentController::class, 'cancel'])->name('cancel');

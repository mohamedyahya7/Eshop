<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\WishlistController;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get( '/dashboard' , fn() => redirect()->route('home'))->name('dashboard');

Route::get('/', [FrontendController::class,'index'])->name('home');
Route::get('/categories', [FrontendController::class,'categories'])->name('categories');
Route::get('/categories/{slug}', [FrontendController::class,'category'])->name('category');
Route::get('/products/{slug}', [FrontendController::class,'product'])->name('product');



Route::post('/addToCart', [CartController::class,'addToCart'])->name('addToCart');
Route::post('/addToWishlist', [WishlistController::class,'addToWishlist'])->name('addToWishlist');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class,'cart'])->name('cart');
    Route::post('/cart/removeFromCart', [CartController::class ,'removeFromCart'])->name('removeFromCart');
    Route::post('/cart/updateQuantity', [CartController::class ,'updateQuantity'])->name('updateQuantity');
    Route::get('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
    Route::post('/place-order', [CheckoutController::class,'placeOrder'])->name('placeOrder');
    Route::get('/order', [OrderController::class,'order'])->name('order');
    
    Route::get('/wishlist', [WishlistController::class,'index'])->name('wishlist');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

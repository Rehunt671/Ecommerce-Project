<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\SalesLogController; 
use App\Http\Controllers\RatingController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/products/category/{id}', [ProductController::class, 'getByCategory'])->name('products.category');;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist', [WishlistController::class, 'getWishlistProducts']);
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlistProduct'])->name('wishlist.toggle');

    Route::get('/cart', [CartController::class, 'getCartProducts']);
    Route::post('/cart/{product}', [CartController::class, 'addCartProduct']);
    Route::put('/cart/{product}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/{product}', [CartController::class, 'deleteCartItem']);

    Route::post('/purchase/{product}', [SalesLogController::class, 'addPurchase']);

    Route::get('/products/{product}/reviews', [RatingController::class, 'getProductReviews']);
    Route::post('/products/{product}/reviews', [RatingController::class, 'addProductReview']);
});

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\PurchaseHistoryController;
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

    Route::get('/wishlist', [WishlistController::class, 'getWishlistProducts'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlistProduct'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeWishlistProduct'])->name('wishlist.remove');

    Route::get('/cart', [CartController::class, 'getCartProducts'])->name('cart.index');;
    Route::post('/cart', [CartController::class, 'upsertCartProduct'])->name('cart.upsert');
    Route::delete('/cart', [CartController::class, 'deleteCartItem'])->name('cart.delete');;

    Route::post('/purchase/{product}', [SalesLogController::class, 'addPurchase']);

    Route::get('/products/{product}/reviews', [RatingController::class, 'getProductReviews']);
    Route::post('/products/{product}/reviews', [RatingController::class, 'addProductReview']);

    Route::get('/purchase-history', [SalesLogController::class, 'getPurchaseHistory'])->name('purchase-history.current');
    
});

require __DIR__.'/auth.php';

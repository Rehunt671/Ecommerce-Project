<?php

use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController; 
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\RatingController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard.index');


Route::get('/product/category/{productId}', [ProductController::class, 'getByCategory'])->name('products.category');;
Route::get('/product/{productId}', [ProductController::class, 'show'])->name('products.show');
  
Route::get('/help', function () {
    return view('help.index');
})->name('help.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist', [WishlistController::class, 'getWishlistProducts'])->name('wishlist.index');
    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlistProduct'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [WishlistController::class, 'removeWishlistProduct'])->name('wishlist.remove');

    Route::get('/cart', [CartController::class, 'getCartProducts'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'upsertCartProduct'])->name('cart.upsert');
    Route::delete('/cart/{productId}', [CartController::class, 'deleteCartItem'])->name('cart.delete');

    Route::get('/order', [OrderController::class, 'getOrders'])->name('order.index');
    Route::post('/order', [OrderController::class, 'addOrder'])->name('order.add');
    
    Route::get('/purchase/{orderId}', [PurchaseController::class, 'getPurchaseByOrder'])->name('purchase.index');
    Route::post('/purchase/{orderId}', [PurchaseController::class, 'purchaseConfirm'])->name('purchase.confirm');
    Route::get('/purchase-history', [PurchaseHistoryController::class, 'getPurchaseHistory'])->name('purchase.history');

    Route::get('/product/{productId}/ratings', [RatingController::class, 'getProductRating'])->name('rating.index');
    Route::get('/product/{productId}/ratings/form', [RatingController::class, 'getAddProductRating'])->name('rating.form');
    Route::post('/product/{productId}/ratings', [RatingController::class, 'addProductRating'])->name('rating.add');
});

require __DIR__.'/auth.php';

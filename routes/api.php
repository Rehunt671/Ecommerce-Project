<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SalesLogController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products/category/{category}', [ProductController::class, 'getByCategory']);

Route::middleware('auth:api')->group(function () {

    Route::get('/wishlist', [WishlistController::class, 'getWishlistProducts']);
    Route::post('/wishlist/{product}', [WishlistController::class, 'addWishlistProduct']);

    Route::get('/cart', [CartController::class, 'getCartProducts']);
    Route::post('/cart/{product}', [CartController::class, 'addCartProduct']);
    Route::put('/cart/{product}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/{product}', [CartController::class, 'deleteCartItem']);

    Route::post('/purchase/{product}', [SalesLogController::class, 'addPurchase']);

    Route::get('/products/{product}/reviews', [ReviewController::class, 'getProductReviews']);
    Route::post('/products/{product}/reviews', [ReviewController::class, 'addProductReview']);
});


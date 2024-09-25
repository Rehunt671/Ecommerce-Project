<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/products/category/{category}', [ProductController::class, 'getByCategory']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/wishlist', [WishlistController::class, 'getWishlistProducts']);
    Route::post('/wishlist/{product}', [WishlistController::class, 'addWishlistProduct']);

    Route::get('/cart', [CartController::class, 'getCartProducts']);
    Route::post('/cart/{product}', [CartController::class, 'addCartProduct']);
    Route::put('/cart/{product}', [CartController::class, 'updateCartItem']);
    Route::delete('/cart/{product}', [CartController::class, 'deleteCartItem']);

    Route::post('/purchase/{product}', [SalesLogController::class, 'addPurchase']);

    Route::get('/products/{product}/reviews', [RatingController::class, 'getProductReviews']);
    Route::post('/products/{product}/reviews', [RatingController::class, 'addProductReview']);

});

require __DIR__.'/auth.php';

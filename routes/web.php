<?php
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::get('products/category/{category}', [ProductController::class, 'getByCategory']);

Route::middleware('auth:api')->group(function () {

    // Wishlist routes
    Route::get('wishlist', [WishlistController::class, 'getWishlistProducts']);
    Route::post('wishlist/{product}', [WishlistController::class, 'addWishlistProduct']);

    // Cart routes
    Route::get('cart', [CartController::class, 'getCartProducts']);
    Route::post('cart/{product}', [CartController::class, 'addCartProduct']);
    Route::put('cart/{product}', [CartController::class, 'updateCartItem']);
    Route::delete('cart/{product}', [CartController::class, 'deleteCartItem']);

    // Purchase routes
    Route::post('purchase/{product}', [PurchaseController::class, 'addPurchase']);

    // Product Reviews routes
    Route::get('products/{product}/reviews', [ReviewController::class, 'getProductReviews']);
    Route::post('products/{product}/reviews', [ReviewController::class, 'addProductReview']);
});


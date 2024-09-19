<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function getWishlistProducts() {
        $user = auth()->user();
        $wishlist = $user->wishlistProducts;
        return response()->json($wishlist);
    }
    public function addWishlistProduct(Request $request) {
        $user = auth()->user();
        $user->wishlistProducts()->attach($request->product_id);
        return response()->json(['message' => 'Product added to wishlist']);
    }
}

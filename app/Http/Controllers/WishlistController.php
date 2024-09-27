<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function getWishlistProducts() {
        $user = auth()->user();
        $wishlists = $user->wishlists;
        return response()->json($wishlists);
    }
    
    public function addWishlistProduct(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:products,id',
        ]);
    
        $user = auth()->user();
        $user->wishlists()->create(['product_id' => $request->product_id]);

        return redirect()->route('products.category', ['id' => $request->category_id])->with('success', 'Product add to wishlist successfully!');
    }
    
    public function removeWishlistProduct(Request $request) {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'category_id' => 'required|exists:products,id',
        ]);
    
        $user = auth()->user();
        $user->wishlists()->where('product_id', $request->product_id)->delete();
    
        return redirect()->route('products.category', ['id' => $category])->with('success', 'Product removed from wishlist successfully!');
    }
    
    
}

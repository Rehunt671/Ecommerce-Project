<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function getWishlistProducts()
    {
        $userId = auth()->id(); 

        $products = DB::table('wishlists')
            ->join('products', 'wishlists.product_id', '=', 'products.id')
            ->leftJoin('cart_items', function ($join) use ($userId) {
                $join->on('cart_items.product_id', '=', 'wishlists.product_id')
                     ->where('cart_items.user_id', '=', $userId);
            })
            ->where('wishlists.user_id', $userId) 
            ->select('products.*', 'cart_items.quantity as cart_quantity') 
            ->paginate(20);
    
        return view("wishlist.index", compact("products"));
    }

    public function toggleWishlistProduct(Request $request) {
        // $request->validate([
        //     'product_id' => 'required|exists:products,id',
        //     'category_id' => 'required|exists:product_categories,id', 
        // ]);
    
        $user = auth()->user();
        
        if ($user->wishlists()->where('product_id', $request->product_id)->exists()) {
            $user->wishlists()->detach($request->product_id);
            $message = 'Product removed from wishlist successfully!';
        } else {
            $user->wishlists()->attach($request->product_id);
            $message = 'Product added to wishlist successfully!';
        }
    
        return redirect()->route('products.category', ['id' => $request->category_id])
                            ->with('success', $message);
    }

    public function removeWishlistProduct(Request $request) {
        // $request->validate([
        //     'product_id' => 'required|exists:products,id',
        //     'category_id' => 'required|exists:product_categories,id', 
        // ]);
    
        $user = auth()->user();
        $user->wishlists()->detach($request->product_id);
        $message = 'Product removed from wishlist successfully!';
        return redirect()->route('wishlist.index')
                            ->with('success', $message);
    }
}

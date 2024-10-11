<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
class ProductController extends Controller
{
    public function getByCategory($id)
    {
        // Find the category by ID or fail
        $category = ProductCategory::findOrFail($id);
    
        // Get the search query from request input
        $query = request()->input('name');
    
        // Get the authenticated user's ID
        $userId = Auth::id(); // Retrieves the currently authenticated user's ID
    
        // Define the cache key
        $cacheKey = "products_category_{$id}";
    
        // Attempt to retrieve products from Redis cache
        $cachedProducts = Redis::get($cacheKey);
    
        if (!$cachedProducts) {
            // Build the query to get products
            $products = DB::table('products')
                ->join('product_categories', 'product_categories.id', '=', 'products.category')
                ->leftJoin('cart_items', function ($join) use ($userId) {
                    $join->on('cart_items.product_id', '=', 'products.id')
                         ->where('cart_items.user_id', '=', $userId);
                })
                ->leftJoin(DB::raw('(SELECT wishlists.product_id FROM users JOIN wishlists ON wishlists.user_id = users.id WHERE users.id = ' . $userId . ') AS user_wishlist'), function($join) {
                    $join->on('user_wishlist.product_id', '=', 'products.id');
                })
                ->select('products.*', 
                         'product_categories.name as category_name', 
                         'user_wishlist.product_id as wishlist_product_id', 
                         'cart_items.id as cart_item_id', 
                         'cart_items.quantity as cart_quantity')
                ->where('product_categories.id', $id)
                ->when($query, function ($queryBuilder) use ($query) {
                    return $queryBuilder->where('products.name', 'like', "%{$query}%");
                })
                ->orderBy('wishlist_product_id')
                ->get(); 
    
            Redis::set($cacheKey, $products->toJson());
            Redis::expire($cacheKey, 3600);
        } else {
            $products = collect(json_decode($cachedProducts)); // This will be a collection of objects
        }
    
        return view('product.index', compact('category', 'products'));
    }
    

}

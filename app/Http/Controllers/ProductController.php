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

    public function show($id) {
        $userId = Auth::check() ? Auth::id() : null; 
        $productQuery = DB::table('products')
            ->join('product_categories', 'product_categories.id', '=', 'products.category')
            ->select('products.*', 
                     'product_categories.name as category_name')
            ->where('products.id', $id) 
            ->leftJoin('cart_items', function ($join) use ($userId) {
                $join->on('cart_items.product_id', '=', 'products.id')
                     ->where('cart_items.user_id', '=', $userId);
            })
            ->leftJoin(DB::raw("(SELECT product_id FROM wishlists WHERE user_id = {$userId}) AS user_wishlist"), function($join) {
                $join->on('user_wishlist.product_id', '=', 'products.id');
            })
            ->addSelect('user_wishlist.product_id as wishlist_product_id', 
                        'cart_items.id as cart_item_id', 
                        'cart_items.quantity as cart_quantity');
    
        $product = $productQuery->first();
        
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        // Fetch ratings for the product
        $ratings = DB::table('ratings')
        ->where('product_id', $id)
        ->join('users', 'users.id', '=', 'ratings.user_id')
        ->select('ratings.*', 'users.name as user_name')
        ->get();
    
         return view('product.detail', compact('product', 'ratings'));
    }

    public function getByCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        
        $query = request()->input('name');
        
        $userId = Auth::check() ? Auth::id() : null; 
    
        $products = DB::table('products')
            ->join('product_categories', 'product_categories.id', '=', 'products.category')
            ->select('products.*', 'product_categories.name as category_name')
            ->where('product_categories.id', $id)
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->whereRaw('LOWER(products.name) LIKE ?', ['%' . strtolower($query) . '%']);
            })
            ->paginate(12);
    
        return view('product.index', compact('category', 'products'));
    }
    
}

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
            ->where('products.id', $id)
            ->join('product_categories', 'product_categories.id', '=', 'products.category')
            ->leftJoin('cart_items', function ($join) use ($userId) {
                $join->on('cart_items.product_id', '=', 'products.id')
                    ->where('cart_items.user_id', '=', $userId);
            })
            ->leftJoin('wishlists', function ($join) use ($userId) {
                $join->on('wishlists.product_id', '=', 'products.id')
                    ->where('wishlists.user_id', '=', $userId);
            })
            ->select(
                'products.*', 
                'product_categories.name as category_name',
                'cart_items.quantity as cart_quantity',
                'wishlists.id as is_wishlist'
            );

        $product = $productQuery->first();

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

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
        $currentPage = request()->get('page', 1);
        $cacheKey = "products:category:{$id}:name:" . ($query ? strtolower($query) : 'all') . ":page:{$currentPage}";
        $cacheExpiration = 3600;
        
        $products = Cache::remember($cacheKey, $cacheExpiration, function () use ($id, $query) {
            return DB::table('products')
                ->join('product_categories', 'product_categories.id', '=', 'products.category')
                ->select('products.*', 'product_categories.name as category_name')
                ->where('product_categories.id', $id)
                ->when($query, function ($queryBuilder) use ($query) {
                    return $queryBuilder->whereRaw('LOWER(products.name) LIKE ?', ['%' . strtolower($query) . '%']);
                })
                ->paginate(12);
        });
    
        return view('product.index', compact('category', 'products'));
    }
}

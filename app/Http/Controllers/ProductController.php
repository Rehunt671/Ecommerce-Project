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
        $category = ProductCategory::findOrFail($id);
        
        $query = request()->input('name');
        
        $userId = Auth::check() ? Auth::id() : null; 
    
        $productsQuery = DB::table('products')
            ->join('product_categories', 'product_categories.id', '=', 'products.category')
            ->select('products.*', 
                     'product_categories.name as category_name');
    
        if ($userId) {
            $productsQuery->leftJoin('cart_items', function ($join) use ($userId) {
                $join->on('cart_items.product_id', '=', 'products.id')
                     ->where('cart_items.user_id', '=', $userId);
            })
            ->leftJoin(DB::raw("(SELECT product_id FROM wishlists WHERE user_id = {$userId}) AS user_wishlist"), function($join) {
                $join->on('user_wishlist.product_id', '=', 'products.id');
            })
            ->addSelect('user_wishlist.product_id as wishlist_product_id', 
                        'cart_items.id as cart_item_id', 
                        'cart_items.quantity as cart_quantity')
            ->orderBy('wishlist_product_id'); 

        }
    
        $products = $productsQuery
        ->where('product_categories.id', $id)
        ->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->whereRaw('LOWER(products.name) LIKE ?', ['%' . strtolower($query) . '%']);
        })
        ->paginate(12);

        return view('product.index', compact('category', 'products'));
    }
}

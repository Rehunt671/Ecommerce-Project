<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis; // Use Redis directly
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    /**
     * Display products by category with optional search query.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function getByCategory($id)
    {
        $category = ProductCategory::findOrFail($id);  

        $query = request()->input('name');
        $cacheKey = "products_category_{$id}";

        $products = Redis::get($cacheKey);

        if ($products) {
            $products = json_decode($products);
        } else {
            $products = $this->fetchProducts($id, $query);
            Redis::setex($cacheKey, 3600, json_encode($products));
        }

        $user = auth()->user();
        $wishlists = $user ? $user->wishlists->pluck('id')->toArray() : [];
        $cartItems = $user ? $user->cartItems->pluck('quantity', 'product_id')->toArray() : [];

        $this->attachWishlistInfo($products, $wishlists);
        $this->attachCartItemInfo($products, $cartItems);

        return view('product.index', compact('category', 'products'));
    }

    protected function fetchProducts($id, $query = null)
    {
        $productQuery = Product::where('category', $id);
    
        if ($query) {
            $productQuery->whereRaw('LOWER(name) LIKE ?', ["%{$query}%"]);
        }
    
        return $productQuery->get(); 
    }

    protected function attachWishlistInfo($products, array $wishlists)
    { 
        foreach ($products as $product) {
            $product->isWishlist = in_array($product->id, $wishlists);
        }
    }

    protected function attachCartItemInfo($products, array $cartItems)
    {  
        foreach ($products as $product) {
            $product->cart_quantity = $cartItems[$product->id] ?? 0;
        }
    }
}

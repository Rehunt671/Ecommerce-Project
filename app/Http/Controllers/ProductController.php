<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

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
        $category = ProductCategory::findOrFail($id);  // Simplified error handling

        $query = request()->input('name');
        $cacheKey = "products_category_{$id}";

        $products = Cache::remember($cacheKey, 60, function () use ($id, $query) {
            return $this->fetchProducts($id, $query);
        });

        $user = auth()->user();
        $wishlists = $user ? $user->wishlists->pluck('id')->toArray() : [];
        $cartItems = $user ? $user->cartItems->pluck('quantity', 'product_id')->toArray() : [];

        $this->attachWishlistInfo($products, $wishlists);
        $this->attachCartItemInfo($products, $cartItems);

        return view('product.index', compact('category', 'products'));
    }

    /**
     * Fetch products by category and optional query.
     *
     * @param int $id
     * @param string|null $query
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function fetchProducts($id, $query = null)
    {
        $productQuery = Product::where('category', $id);

        if ($query) {
            $productQuery->whereRaw('LOWER(name) LIKE ?', ["%{$query}%"]);
        }

        return $productQuery->paginate(20);
    }

    /**
     * Attach wishlist status to products.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $products
     * @param array $wishlists
     * @return void
     */
    protected function attachWishlistInfo($products, array $wishlists)
    { 
        foreach ($products as $product) {
            $product->isWishlist = in_array($product->id, $wishlists);
        }
    }

    /**
     * Attach cart item quantity to products.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $products
     * @param array $cartItems
     * @return void
     */
    protected function attachCartItemInfo($products, array $cartItems)
    {  
        foreach ($products as $product) {
            $product->cart_quantity = $cartItems[$product->id] ?? 0;
        }
        
    }
}

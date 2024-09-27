<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{

    public function getByCategory($id)
    {
        $category = ProductCategory::find($id);
        if (!$category) {
            return abort(404, 'Category not found');
        }
    
        $products = Cache::remember("products_category_{$id}", 60, function() use ($id) {
            return Product::with('cartItems.cart.user') 
                ->where('category', $id)
                ->paginate(20);
        });
    
        $user = auth()->user();
        $wishlist = $user ? $user->wishlists->pluck('id')->toArray() : [];
    
        $this->attachWishlistStatus($products, $wishlist);
    
        return view('product.products', compact('category', 'products'));
    }
    
    /**
     * Attach wishlist status to products.
     *
     * @param \Illuminate\Pagination\LengthAwarePaginator $products
     * @param array $wishlist
     * @return void
     */
    protected function attachWishlistStatus($products, $wishlist)
    {
        foreach ($products as $product) {
            $product->isWishlist = in_array($product->id, $wishlist);
        }
    }
    
}


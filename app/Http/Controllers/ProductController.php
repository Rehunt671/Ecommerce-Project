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
        $query = request()->input('query');

        $products = Cache::remember("products_category_{$id}_query_" . ($query ?: 'none'), 60, function() use ($id, $query) {
            $productQuery = Product::with('cartItems.cart.user')->where('category', $id);
            
            if ($query) {
                $productQuery->whereRaw('LOWER(name) LIKE ?', ["%{$query}%"]);
            }

            return $productQuery->paginate(20);
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


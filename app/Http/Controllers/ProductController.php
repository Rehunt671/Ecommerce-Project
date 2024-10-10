<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis; // Use Redis directly
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    public function getByCategory($id)
    {
        $category = ProductCategory::findOrFail($id);  
    
        $query = request()->input('name');
        $cacheKey = "products_category_{$id}";
    
        $products = Redis::get($cacheKey);
    
        if ($products) {
            $products = json_decode($products, true);
        } else {
            $products = $this->fetchProducts($id)->toArray();
            Redis::setex($cacheKey, 3600, json_encode($products));
        }
    
        $products = $this->searchProducts($products, $query);
    
        $user = auth()->user();
        $wishlists = $user ? $user->wishlists->pluck('id')->toArray() : [];
        $cartItems = $user ? $user->cartItems->pluck('quantity', 'product_id')->toArray() : [];
    
        $this->attachWishlistInfo($products, $wishlists);
        $this->attachCartItemInfo($products, $cartItems);
    
        // Order products
        $products = $this->orderProducts($products);
    
        // Paginate products
        $products = $this->paginateProducts($products);
    
        return view('product.index', compact('category', 'products'));
    }
    

    private function orderProducts($products)
    {
        usort($products, function($a, $b) {
            return ($b['isWishlist'] <=> $a['isWishlist']); // Sort descending (true first)
        });

        return $products;
    }

    private function paginateProducts($products)
    {
        $perPage = 5; 
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = array_slice($products, ($currentPage - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($currentItems, count($products), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'query' => request()->query(),
        ]);
    }

    protected function fetchProducts($id)
    {
        $productQuery = Product::where('category', $id);
        return $productQuery->get(); 
    }

    public function searchProducts($products, $query)
    {
        if (empty($query)) {
            return $products; 
        }

        return array_filter($products, function ($product) use ($query) {
            return stripos($product->name, $query) !== false; // Check if the name contains the query
        });
    }

    protected function attachWishlistInfo(&$products, array $wishlists)
    {
        foreach ($products as &$product) { 
            $product['isWishlist'] = in_array($product['id'], $wishlists);
        }
    }
    
    
    protected function attachCartItemInfo(&$products, array $cartItems)
    {  
        foreach ($products as &$product) { 
            $product['cart_quantity'] = $cartItems[$product['id']] ?? 0;
        }
    }
}

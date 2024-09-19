<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getByCategory($category) {
        $products = Cache::remember("products_$category", 60, function() use ($category) {
            return Product::where('category', $category)->get();
        });
        return response()->json($products);
    }
    
}

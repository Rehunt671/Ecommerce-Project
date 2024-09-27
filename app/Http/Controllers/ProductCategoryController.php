<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function getProductCategories()
    {
        $categories = ProductCategory::all(); 
        return view('/products', compact('categories')); 
    }
}

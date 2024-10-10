<?php

namespace App\View\Components;

use App\Models\Product; // Make sure to import your Product model
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $product;

    public function __construct($product)
    {
        $this->product = $product; 
    }

    public function render()
    {
        return view('components.product-card');
    }
}

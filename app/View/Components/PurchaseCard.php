<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class PurchaseCard extends Component
{
    public $product;

    public function __construct(Order $order)
    {
        $this->product = $product; 
    }


    public function render()
    {
        return view('components.purchase-card');
    }
}

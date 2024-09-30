<?php

namespace App\View\Components;

use App\Models\Product;
use App\Models\SalesLog;
use Illuminate\View\Component;

class PurchaseCard extends Component
{
    public $purchase;
    public $productName;

    public function __construct(SalesLog $purchase)
    {
        $this->purchase = $purchase;

        // Get the product name through the relationship
        $this->productName = $purchase->product->name ?? 'Product not found'; // Fallback if product is null
    }

    public function render()
    {
        return view('components.purchase-card', [
            'productName' => $this->productName,
        ]);
    }
}

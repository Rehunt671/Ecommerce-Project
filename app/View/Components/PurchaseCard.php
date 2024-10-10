<?php

namespace App\View\Components;

use App\Models\Order;
use Illuminate\View\Component;

class PurchaseCard extends Component
{
    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order; 
    }

    public function render()
    {
        return view('components.order-history-card');
    }
}

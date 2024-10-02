<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function getPurchaseHistory()
    {
        $user = auth()->user();
        
        $orders = $user->orders()
            ->whereNotNull('purchase_date')  
            ->with(['orderItems.product'])
            ->paginate(20);
    
        // Log the orders
        Log::info('User Purchase History:', [
            'orders' => $orders->toArray() // Convert the orders collection to an array for logging
        ]);
    
        // return response()->json($orders);
        return view('purchase.history', compact('orders'));
    }
}

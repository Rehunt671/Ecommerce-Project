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
    
    public function getPurchaseByOrder($orderId)
    {
        $user = auth()->user();

        $order = $user->orders()
                    ->where('user_id', $user->id)
                    ->firstOrFail();

        // Log the order details
        Log::info('User Order:', ['order' => $order->toArray()]);

        // return response()->json($order);
        return view('purchase.index', compact('order'));
    }
}

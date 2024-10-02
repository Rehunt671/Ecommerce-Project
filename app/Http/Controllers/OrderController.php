<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function addOrder()
    {
        $user = auth()->user();
    
        $cartItems = $user->cartItems;
    
        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
    
        $order = Order::create([
            'user_id' => $user->id,
            'purchase_date' => now(),
        ]);
    
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity_sold' => $cartItem->quantity,
                'price_per_item' => $cartItem->product->price, 
            ]);
        }
    
        $user->cartItems()->delete();
    
        // return response()->json($order);
        return redirect()->route('purchase.index', ['orderId' => $order->id])
                     ->with('success', 'Order successfully placed!');  // this should pass order variable too
    }
    
}

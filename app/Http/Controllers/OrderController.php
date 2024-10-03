<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addOrder(Request $request)
    {
        $user = auth()->user();
        $productId = $request->product_id; 
        $quantity = $request->quantity; 
        $cartItems = $user->cartItems()->with('product')->get();
        $order = null; 
    
        DB::transaction(function () use ($user, $cartItems, $productId, $quantity, &$order) {
            $order = Order::create([
                'user_id' => $user->id,
                'purchase_date' => null,
            ]);
            
            if ($productId && $quantity) {
                $product = Product::find($productId); 
                if ($product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $productId,
                        'quantity_sold' => $quantity,
                        'price_per_item' => $product->price, 
                    ]);
                } else {
                    throw new \Exception("Product not found.");
                }
            } else {
                foreach ($cartItems as $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity_sold' => $cartItem->quantity,
                        'price_per_item' => $cartItem->product->price, 
                    ]);
                }
                $user->cartItems()->delete();
            }
        });
    
        return redirect()->route('purchase.index', ['orderId' => $order->id])
                     ->with('success', 'Order successfully placed!');
    }
    
}

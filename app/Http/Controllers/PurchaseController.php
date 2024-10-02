<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class PurchaseController extends Controller
{
    public function getPurchaseByOrder($orderId)
    {
        $user = auth()->user();
        
        $order = $user->orders()
            ->where('id', $orderId)
            ->with(['orderItems.product'])
            ->paginate(20);
    
        // Log the orders
        Log::info('User Purchase :', [
            'order' => $order->toArray() // Convert the orders collection to an array for logging
        ]);
    
        // return response()->json($order);
        return view('purchase.index', compact('order'));
    }

    public function purchaseConfirm($orderId)
    {
        $user = auth()->user();
    
        // ค้นหา Order ที่ตรงกับ user และ orderId
        $order = Order::where('id', $orderId)->where('user_id', $user->id)->first();
    
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }
    
        // อัปเดต purchase_date เป็นวันที่ปัจจุบัน
        $order->purchase_date = now(); // ใช้ now() เพื่อรับวันที่และเวลาปัจจุบัน
        $order->save(); // บันทึกการเปลี่ยนแปลง
    
        return redirect()->route('cart.index')->with('success', 'Purchase confirmed successfully!');
    }
    
}

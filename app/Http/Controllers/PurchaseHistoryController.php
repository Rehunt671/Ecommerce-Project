<?php

namespace App\Http\Controllers;

use App\Models\Order; 
use Illuminate\Http\Request;

class PurchaseHistoryController extends Controller
{
    public function getPurchaseHistory()    
    {
        $user = auth()->user();

        // ดึงข้อมูลการซื้อสินค้าของผู้ใช้ที่ล็อกอิน
        $products = Order::where('user_id', $user->id)
            ->whereNotNull('sale_date')
            ->paginate(20);

        // ส่งข้อมูลไปยัง view หรือ JSON response
        return view('purchase.history', compact('products'));
    }
}

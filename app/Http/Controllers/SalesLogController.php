<?php

namespace App\Http\Controllers;

use App\Models\SalesLog;
use Illuminate\Http\Request;

class SalesLogController extends Controller
{
    public function addPurchase(Request $request) {
        $user = auth()->user();
        $purchase = $user->purchases()->create($request->all());
        return response()->json($purchase, 201);
    }
    
    /**
     * ฟังก์ชันสำหรับดึงประวัติการซื้อสินค้าของผู้ใช้ที่ล็อกอินอยู่
     */
    public function getPurchaseHistory()
    {
        $user = auth()->user();

        // ดึงข้อมูลการซื้อสินค้าของผู้ใช้ที่ล็อกอิน
        $purchaseHistory = SalesLog::where('user_id', $user->id)->paginate(20);

        // ส่งข้อมูลไปยัง view หรือ JSON response
        return view('purchase-history.index', compact('purchaseHistory'));
    }

}
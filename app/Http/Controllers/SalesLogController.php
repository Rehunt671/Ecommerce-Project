<?php

namespace App\Http\Controllers;

use App\Models\SaleLog;
use Illuminate\Http\Request;

class SalesLogController extends Controller
{
    public function addPurchase(Request $request) {
        $user = auth()->user();
        $purchase = $user->purchases()->create($request->all());
        return response()->json($purchase, 201);
    }
    
}

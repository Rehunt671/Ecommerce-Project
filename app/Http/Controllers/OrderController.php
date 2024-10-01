<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addOrder(Request $request) {
        $user = auth()->user();
        $cartItems = $user->cartItems();
        return view('cart.index', compact('cartItems'));
    }
    
}

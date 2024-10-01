<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getCartProducts() {
        $user = auth()->user();
        
        $cartProducts = $user->products()->withPivot('quantity')->get();
        
        // return response()->json($cartProducts);
        return view("cart.index", compact("cartProducts"));
    }

    public function upsertCartProduct(Request $request) {
        $user = auth()->user();
        $productId = $request->input('product_id');
        $operation = $request->input('operation', 'add'); 
        $quantity = $request->input('quantity', 1);
    
        $cartProduct = $user->cartItems()
            ->where('product_id', $productId)
            ->first();
    
        if ($cartProduct) {
            if ($operation === 'add') {
                $cartProduct->quantity += $quantity;
            } elseif ($operation === 'minus') {
                $cartProduct->quantity -= $quantity;
            }
    
            if ($cartProduct->quantity <= 0) {
                $cartProduct->delete();
            } else {
                $cartProduct->save();
            }
        } else {
            $cartProduct = $user->cartItems()
                ->create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
        }
    
        return redirect()->back();
    }
    
    public function deleteCartItem($productId) {
        $user = auth()->user();

        $cartProduct = $user->cartItems()
            ->where('product_id', $productId)
            ->first();

        if ($cartProduct) {
            $cartProduct->delete();
            return response()->json(['message' => 'Cart item deleted successfully']);
        }

        return response()->json(['message' => 'Cart item not found'], 404);
    }
}

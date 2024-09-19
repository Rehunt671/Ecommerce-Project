<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getCartProducts() {
        $user = auth()->user();
        $cart = $user->cart; 
        $cartItems = $cart->cartItems; 
    
        $cartItems->load('product');
    
        return response()->json($cartItems);
    }

    public function addCartProduct(Request $request) {
        $user = auth()->user();
        $cart = $user->cart;  

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem = $cart->cartItems()->where('product_id', $validated['product_id'])->first();
    
        if ($cartItem) {
            $cartItem->update(['quantity' => $validated['quantity']]);
        } else {
            $cart->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => $validated['quantity']
            ]);
        }
    
        return response()->json(['message' => 'Product added to cart']);
    }
    

    public function updateCartItem(Request $request, $productId) {
        $user = auth()->user();  
        $cart = $user->cart;  
        
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->update(['quantity' => $validated['quantity']]);
            return response()->json(['message' => 'Cart item updated']);
        } else {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }
    
    
    public function deleteCartItem($productId) {
        $user = auth()->user();
        $cart = $user->cart;
    
        $cartItem = $cart->cartItems()->where('product_id', $productId)->first();
    
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart']);
        } else {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
    }
    
}

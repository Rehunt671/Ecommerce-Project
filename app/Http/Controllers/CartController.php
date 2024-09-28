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

    public function upsertCartProduct(Request $request) {
        $user = auth()->user();
        $cart = $user->cart;  
    
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1' // Optional, defaults to 1 for new products
        ]);
    
        $product = $cart->cartItems()->where('product_id', $validated['product_id'])->first();
        $productDetails = Product::find($validated['product_id']); // Get product details to access the price
    
        if ($product) {
            // If the item exists, increment the quantity by 1
            $product->increment('quantity', 1);
            // Update the total price of the cart
            $cart->totalPrice += $productDetails->price; // Add product price to total
            $cart->save(); // Save the cart
            return response()->json(['message' => 'Cart item quantity updated']);
        } else {
            // If the item does not exist, create a new cart item with quantity of 1
            $cart->cartItems()->create([
                'product_id' => $validated['product_id'],
                'quantity' => 1 
            ]);
            // Update the total price of the cart
            $cart->totalPrice += $productDetails->price; // Add product price to total
            $cart->save(); // Save the cart
            return response()->json(['message' => 'Product added to cart']);
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

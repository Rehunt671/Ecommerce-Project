<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function getProductRating($productId) {
        $ratings = Rating::with('user')->where('product_id', $productId)->get();
        // Passing the $ratings variable to the view
        return view('rating.index', compact('ratings'));
    }

    public function addProductRating(Request $request, $productId) {
        $product = Product::findOrFail($productId);
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:255'
        ]);

        $user = auth()->user();

        $rating = Rating::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'review_text' => $request->review_text
        ]);

        // return response()->json($rating, 201);
        return redirect()->route('rating.index', ['product' => $product->id]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function getProductRating($productId) {
        $ratings = Rating::with('user')->where('product_id', $productId)->get();
        // Passing the $ratings variable to the view
        return view('rating.index', compact('ratings'));
    }
    
    public function addProductRating(Request $request, $productId) {
        $user = auth()->user();
        
        $rating = Rating::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'review_text' => $request->review_text 
        ]);

        return response()->json($rating, 201);
    }
}

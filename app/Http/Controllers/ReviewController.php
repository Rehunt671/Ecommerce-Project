<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getProductReviews($productId) {
        $reviews = Review::where('product_id', $productId)->get();
        return response()->json($reviews);
    }

    public function addProductReview(Request $request, $productId) {
        $user = auth()->user();
        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);
        return response()->json($review, 201);
    }
    
}

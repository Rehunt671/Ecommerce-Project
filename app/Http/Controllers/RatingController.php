<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RatingController extends Controller
{
    public function getProductRating($productId) {
        $ratings = Rating::with('user')->where('product_id', $productId)->get();
        // Passing the $ratings variable to the view
        return view('rating.index', compact('ratings'));
    }

    public function getAddProductRating($productId)
    {
        $product = Product::find($productId);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
    
        return view('rating.add', compact('product'));
    }
    
    public function addProductRating(Request $request, $productId) {
        $product = Product::findOrFail($productId);
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:255'
        ]);

        $user = auth()->user();

        $ratings = Rating::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'review_text' => $request->review_text
        ]);

        $ratings = DB::table('ratings')
        ->where('product_id', $productId)
        ->join('users', 'users.id', '=', 'ratings.user_id')
        ->select('ratings.*', 'users.name as user_name')
        ->get();
        
        return view('product.detail', compact('product', 'ratings'));
    }
}

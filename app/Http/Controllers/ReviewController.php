<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;


class ReviewController extends Controller
{

    public function store(Request $request)
    {
        //$user = DB::table('users')->where('id',Auth::user()->id)->first();
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:255',
            //'product_id' => 'required|integer',
        ]);
    
        $review = review::create([
            'stars_rated' => $request->rating,
            'comment' => $request->comment,
        ]);
        $saved = $review->save();
        return redirect()->route('reviews');
    }
}
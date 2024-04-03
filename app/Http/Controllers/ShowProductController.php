<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
        ]);
        $page = $validated['page'] ?? 1;
        $limit = 5; // set the number of products per page
        $products = Product::paginate($limit, ['*'], 'page', $page);
        $reviews = Review::all();
        $allProduct = Product::all()->count();
        $totalPage = ceil($allProduct / $limit);
        return view('front-end.products',compact('products', 'reviews', 'totalPage', 'page'));
    }

    public function ShowProductleftThumbnail($id)
    {
        $product = Product::find($id);
        $reviews = Review::all();
        return view('front-end.product-left-thumbnail',compact('product','reviews'));
    }
}

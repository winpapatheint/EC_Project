<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
        ]);
        $page = $validated['page'] ?? 1;
        $limit = 10; // set the number of products per page
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
        $productOrdered = Order::where('product_id', $id)->get();
        $topProducts = Order::select('product_id', DB::raw('COUNT(*) as frequency'))
        ->groupBy('product_id')
        ->orderByDesc('frequency')
        ->limit(3)
        ->get();
        return view('front-end.product-left-thumbnail',compact('product','reviews', 'productOrdered', 'topProducts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class ShowProductController extends Controller
{
    public function ShowProductList()
    {
        $validated = request()->validate([
            'page' => 'integer|min:1',
            'sort' => 'integer|min:1',
        ]);
        $page = $validated['page'] ?? 1;
        $sort = $validated['sort'] ?? 0;
        $limit = 10; // set the number of products per page
        if ($sort == 1) {
            $products = Product::orderByRaw('CAST(selling_price AS DECIMAL(10,2)) ASC')->paginate($limit, ['*'], 'page', $page);
        }
        elseif ($sort == 2) {
            $products = Product::orderByRaw('CAST(selling_price AS DECIMAL(10,2)) DESC')->paginate($limit, ['*'], 'page', $page);
        }
        elseif ($sort == 3) {
            $products = Product::leftJoin('reviews', 'products.id', '=', 'reviews.product_id')
                                ->select('products.*', DB::raw('COUNT(reviews.product_id) as review_count'))
                                ->groupBy('products.id')
                                ->orderBy('review_count', 'desc')
                                ->paginate($limit, ['*'], 'page', $page);
        }
        elseif ($sort == 4) {
            $products = Product::orderBy('product_name', 'ASC')->paginate($limit, ['*'], 'page', $page);
        }
        elseif ($sort == 5) {
            $products = Product::orderBy('product_name', 'DESC')->paginate($limit, ['*'], 'page', $page);
        }elseif ($sort == 6) {
            $products = Product::orderByRaw('CAST(discount_percent AS DECIMAL(10,2)) DESC')->paginate($limit, ['*'], 'page', $page);
        }else {
            $products = Product::paginate($limit, ['*'], 'page', $page);
        }
        $reviews = Review::all();
        $allProduct = Product::all()->count();
        $totalPage = ceil($allProduct / $limit);
        return view('front-end.products',compact('products', 'reviews', 'totalPage', 'page'));
    }

    public function ShowProductleftThumbnail($id)
    {
        $product = Product::find($id);
        $reviews = Review::all();
        $productOrdered = Orders::where('product_id', $id)->get();
        $topProducts = Orders::select('product_id', DB::raw('COUNT(*) as frequency'))
        ->groupBy('product_id')
        ->orderByDesc('frequency')
        ->limit(3)
        ->get();
        return view('front-end.product-left-thumbnail',compact('product','reviews', 'productOrdered', 'topProducts'));
    }
}

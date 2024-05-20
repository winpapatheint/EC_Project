<?php

namespace App\View\Components;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Category;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $categories = Category::with(['subCategoryTitle', 'subCategoryTitle.subCategory'])
            ->where('category_name', '!=', 'Special Corner')
            ->get();

        $todayDate = Carbon::now()->toDateString();

        $specialCorner = Category::with(['subCategoryTitle', 'subCategoryTitle.subCategory'])
                                    ->where('category_name', 'Special Corner')
                                    ->get();
        $allCategories = Category::all();
        $newBlogsExist = Blog::where('created_at', '>=', Carbon::now()->subDays(7))->exists();
        $buyer = Buyer::where('user_id', Auth::user()->id)->first();
        $deal = Product::leftjoin('order_details', 'products.id', 'order_details.product_id')
                    ->leftjoin('orders', 'order_details.order_id', 'orders.id')
                    ->select('products.*')
                    ->where('order_details.buyer_id', $buyer->id)
                    ->whereDate('order_details.created_at', $todayDate)
                    ->orderBy('orders.order_code', 'desc')
                    ->get();

        return view('layouts.guest',compact('deal', 'allCategories', 'specialCorner', 'newBlogsExist', 'categories', 'deal'));
    }
}

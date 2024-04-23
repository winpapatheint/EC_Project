<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

        $deal = DB::table('products')
                ->select('products.*')
                ->whereNotNull('discount_percent')
                ->whereDate('created_at', $todayDate)
                ->get();

        $specialCorner = Category::with(['subCategoryTitle', 'subCategoryTitle.subCategory'])
                                    ->where('category_name', 'Special Corner')
                                    ->get();
        $allCategories = Category::all();
        $newBlogsExist = Blog::where('created_at', '>=', Carbon::now()->subDays(7))->exists();
        $deal = Product::whereDate('created_at', $todayDate)->where('status', 1)->where('discount_percent', '!=', null)->get();

        return view('layouts.guest',compact('deal', 'allCategories', 'specialCorner', 'newBlogsExist', 'categories', 'deal'));
    }
}

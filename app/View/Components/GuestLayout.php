<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Product;
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
        $categories = DB::table('categories')
                            ->select(
                                'categories.id',
                                'categories.category_name as category_name',
                                'categories.category_icon',
                                'sub_category_titles.id as subcategorytitle_id',
                                'sub_category_titles.sub_category_titlename as subcategorytitle_name',
                                'sub_categories.id as subcategory_id',
                                'sub_categories.sub_category_name as subcategory_name',
                                'sub_categories.sub_category_title_id as subcategory_titleid',
                                )
                            ->leftjoin('sub_category_titles', 'categories.id', '=', 'sub_category_titles.category_id')
                            ->leftjoin('sub_categories', 'sub_categories.sub_category_title_id', '=', 'sub_category_titles.id')

                            ->get();
       // Organize categories and their subcategories
        $organizedcategories = [];
            foreach ($categories as $category) {
                $categoryId = $category->id;
                    if (!isset($organizedcategories[$categoryId])) {
                        $organizedcategories[$categoryId] = [
                            'id' => $categoryId,
                            'name' => $category->category_name,
                            'icon' => $category->category_icon,
                            'subcategories' => [],
                            'sub' => []
                        ];
                    }
                    if (!is_null($category->subcategory_id)) {
                        $organizedcategories[$categoryId]['subcategories'][] = [
                            'id' => $category->id,
                            'subid' => $category->subcategorytitle_id,
                            'name' => $category->subcategorytitle_name
                        ];
                    }

                    if (!is_null($category->subcategorytitle_id)) {
                        $organizedcategories[$categoryId]['sub'][] = [
                            'id' => $category->subcategory_id,
                            'subid' => $category->subcategory_titleid,
                            'name' => $category->subcategory_name,

                        ];
                    }
            }

            $todayDate = Carbon::now()->toDateString();

            $deal = DB::table('products')
                            ->select('products.*')
                            ->whereNotNull('discount_percent')
                            ->whereDate('created_at', $todayDate)
                            ->get();

        $myanmarProducts = Product::leftjoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->leftjoin('sub_category_titles', 'sub_categories.sub_category_title_id', '=', 'sub_category_titles.id')
                            ->leftjoin('categories', 'sub_category_titles.category_id', '=', 'categories.id')
                            ->select('products.*', 'categories.category_name', 'sub_category_titles.sub_category_titlename', 'sub_categories.sub_category_name')
                            ->where('categories.category_name', 'Asia Menu')
                            ->where('sub_category_titles.sub_category_titlename', 'Myanmar')
                            ->get();
        $koreaProducts = Product::leftjoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->leftjoin('sub_category_titles', 'sub_categories.sub_category_title_id', '=', 'sub_category_titles.id')
                            ->leftjoin('categories', 'sub_category_titles.category_id', '=', 'categories.id')
                            ->select('products.*', 'categories.category_name', 'sub_category_titles.sub_category_titlename', 'sub_categories.sub_category_name')
                            ->where('categories.category_name', 'Asia Menu')
                            ->where('sub_category_titles.sub_category_titlename', 'Korea')
                            ->get();
        $chinaProducts = Product::leftjoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.id')
                            ->leftjoin('sub_category_titles', 'sub_categories.sub_category_title_id', '=', 'sub_category_titles.id')
                            ->leftjoin('categories', 'sub_category_titles.category_id', '=', 'categories.id')
                            ->select('products.*', 'categories.category_name', 'sub_category_titles.sub_category_titlename', 'sub_categories.sub_category_name')
                            ->where('categories.category_name', 'Asia Menu')
                            ->where('sub_category_titles.sub_category_titlename', 'China')
                            ->get();
        $allCategories = Category::all();

        return view('layouts.guest', ['categories' => $organizedcategories],compact('deal', 'myanmarProducts', 'koreaProducts', 'chinaProducts', 'allCategories'));

    }
}

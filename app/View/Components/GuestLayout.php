<?php

namespace App\View\Components;

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
        // $categories = DB::table('Categorys')
        // ->select('Categorys.id', 'Categorys.category_name as category_name',
        // 'Sub_category_titles.category_id as subcategory_id', 'Sub_category_titles.sub_category_titlename as subcategory_name')
        // ->leftJoin('Sub_category_titles', 'Categorys.id', '=', 'Sub_category_titles.category_id')
        // ->leftJoin('Sub_categories', 'Categorys.id', '=', 'Sub_categories.category_id' and 'Sub_category_titles.id','=',
        // 'sub_category_title_id')
        // ->get();

        $categories = DB::table('categories')
            ->select(
                'categories.id',
                'categories.category_name as category_name',
                'sub_category_titles.category_id as subcategory_id',
                'sub_categories.sub_category_title_id as subcategorytitle_id',
                'sub_category_titles.sub_category_titlename as subcategory_name',
                'sub_categories.sub_category_name as sub_name'
    )
    ->leftjoin('sub_category_titles', 'categories.id', '=', 'sub_category_titles.category_id')
    ->Join('sub_category_titles', function($join) {
        $join
            ->on('sub_category_titles.id', '=', 'sub_categories.sub_category_title_id');
    })
    ->get();

       // Organize categories and their subcategories
        $organizedCategories = [];
            foreach ($categories as $category) {
                $categoryId = $category->id;
                    if (!isset($organizedCategories[$categoryId])) {
                        $organizedCategories[$categoryId] = [
                            'id' => $categoryId,
                            'name' => $category->category_name,
                            'subcategories' => [],
                            'sub' => []
                        ];
                    }
                    if (!is_null($category->subcategory_id)) {
                        $organizedCategories[$categoryId]['subcategories'][] = [
                            'id' => $category->subcategory_id,
                            'subid' => $category->subcategorytitle_id,
                            'name' => $category->subcategory_name
                        ];
                    }

                    if (!is_null($category->subcategorytitle_id)) {
                        $organizedCategories[$categoryId]['sub'][] = [
                            'id' => $category->subcategorytitle_id,
                            'name' => $category->sub_name
                        ];
                    }
            }

            $todayDate = Carbon::now()->toDateString();

            $deal = DB::table('products')
                            ->select('products.*')
                            ->whereNotNull('discount_percent')
                            ->whereDate('created_at', $todayDate)
                            ->get();
                            
        return view('layouts.guest', ['categories' => $organizedCategories],compact('deal'));

    }
}

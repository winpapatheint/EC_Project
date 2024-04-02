<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {


$categories = DB::table('Categorys')
->leftJoin('Sub_category_titles AS subcategories', 'Categorys.id', '=', 'subcategories.category_id')
->select('Categorys.id', 'Categorys.category_name AS category_name', 'subcategories.sub_category_titlename AS subcategory_title')

->get();

        // $list = DB::table('Categorys as C')
        //             ->select('C.*','C.id')
        //             ->orderBy('C.created_at', 'desc')->paginate(999);

        // $subtitle = DB::table('Categorys as C')
        //             ->select('Subtitle.sub_category_titlename as subtitle','Subtitle.*')
        //             ->join('Sub_category_titles as Subtitle', function ($join) {
        //                 $join->on('C.id', '=', 'Subtitle.category_id');
        //             })




        return view('layouts.guest',compact('categories'));
    }
}

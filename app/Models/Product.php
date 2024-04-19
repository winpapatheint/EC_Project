<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'brand_id',
        'country_id',
        'category_id',
        'sub_category_title_id',
        'sub_category_id',
        'seller_id',
        'subseller_id',
        'product_name',
        'product_code',
        'product_qty',
        'product_tags',
        'product_size',
        'product_color',
        'selling_price',
        'discount_percent',
        'short_desc',
        'long_desc',
        'product_thambnail',
        'commission',
        'com_price',
        'seller_amount',
        'status',
        'estimate_date',
        'updated_name',
    ];

    function Country() {
        return $this->belongsTo(Country::class,'country_id');
    }

    function Brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    function Category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    function SubCategory() {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    function SubCategoryTitle() {
        return $this->belongsTo(SubCategoryTitle::class,'sub_category_title_id');
    }

}

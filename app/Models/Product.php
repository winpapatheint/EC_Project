<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'country_id',
        'category_id',
        'sub_category_title_id',
        'sub_category_id',
        'seller_id',
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
        'comession',
        'com_price',
        'status',
        'estimate_date',
        'updated_name',
    ];
    function Brand() {
        return $this->belongsTo(Brand::class,'brand_id');
    }
}

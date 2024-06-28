<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code',
        'brand_id',
        'country_id',
        'category_id',
        'sub_category_title_id',
        'sub_category_id',
        'special_sub_category_id',
        'seller_id',
        'subseller_id',
        'product_name',
        'product_qty',
        'in_stock',
        'product_tags',
        'product_size',
        'product_color',
        'original_price',
        'selling_price',
        'seller_amount',
        'discount_percent',
        'short_desc',
        'long_desc',
        'care_instructions',
        'product_thambnail',
        'commission',
        'commission_status',
        'com_price',
        'status',
        'coupon_status',
        'coupon_id',
        'estimate_date',
        'delivery_price',
        'shipping_country',
        'updated_by'
    ];

    function Country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    function Brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function Seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'user_id');
    }

    function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function SubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    function SubCategoryTitle()
    {
        return $this->belongsTo(SubCategoryTitle::class, 'sub_category_title_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}

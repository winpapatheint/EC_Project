<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_code',
        'buyer_id',
        'payment_id',
        'total_qty',
        'total_amount',
        'sub_total_amount',
        'coupon_discount_amountt',
        'coupon_used_seller_id',
        'coupon_used_product_id',
        'shipping_fee',
        'payment_type',
        'created_at',
        'updated_at',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}

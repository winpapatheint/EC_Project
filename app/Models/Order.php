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
        'seller_id',
        'buyer_id',
        'payment_id',
        'total_qty',
        'total_amount',
        'sub_total_amount',
        'coupon_discount_amout',
        'shipping_fee',
        'payment_type',
        'created_at',
        'updated_at',
    ];
}

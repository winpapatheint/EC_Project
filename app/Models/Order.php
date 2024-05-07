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
        'payment_type',
        'created_at',
        'updated_at',
    ];

    function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    function product() {
        return $this->belongsTo(Product::class,'product_id');
    }

    function prefecture() {
        return $this->belongsTo(Prefecture::class,'prefecture_id');
    }

    function seller() {
        return $this->belongsTo(Seller::class,'seller_id');
    }
}

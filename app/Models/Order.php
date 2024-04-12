<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'prefecture_id',
        'product_id',
        'transaction_id',
        'order_code',
        'color',
        'size',
        'qty',
        'price',
        'post_code',
        'notes',
        'city',
        'chome',
        'building',
        'room',
        'payment_type',
        'payment_method',
        'amount',
        'order_number',
        'invoice_no',
        'order_date',
        'order_month',
        'order_year',
        'confirmed_date',
        'processing_date',
        'picked_date',
        'shipped_date',
        'delivered_date',
        'cancel_date',
        'return_date',
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

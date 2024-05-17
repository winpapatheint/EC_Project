<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'buyer_id',
        'prefecture_id',
        'product_id',
        'seller_id',
        'color',
        'size',
        'qty',
        'price',
        'notes',
        'name',
        'phone',
        'post_code',
        'city',
        'chome',
        'building',
        'room_no',
        'amount',
        'invoice_no',
        'status',
        'processing_date',
        'confirmed_date',
        'expected_from',
        'expected_to',
        'picked_date',
        'shipped_date',
        'delivered_date',
        'cancel_date',
        'cancelled_reason',
        'return_date',
        'returned_reason',
        'updated_by',
        'created_at',
        'updated_at',

    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    function buyer() {
        return $this->belongsTo(Buyer::class,'buyer_id');
    }

    function prefecture() {
        return $this->belongsTo(Prefecture::class,'prefecture_id');
    }

    function seller() {
        return $this->belongsTo(Seller::class,'seller_id', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

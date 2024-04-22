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
        'amount',
        'invoice_no',
        'status',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}

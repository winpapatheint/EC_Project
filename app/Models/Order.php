<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'seller_id',
        'buyer_id',
        'payment_id',
        'total_qty',
        'total_amount',
        'post_code',
        'city',
        'chome',
        'building',
        'room_no',
        'processing_date',
        'confirmed_date',
        'picked_date',
        'shipped_date',
        'delivered_date',
        'cancel_date',
        'cancelled_reason',
        'return_date',
        'returned_reason',
        'payment_type',
        'expected_from',
        'expected_to',
        'updated_by',
        'created_at',
        'updated_at',

    ];
}

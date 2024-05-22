<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_detail_id',
        'seller_id',
        'commission',
        'commission_amount',
        'status',
        'transferred_at',
        'created_at',
        'updated_at',
    ];
}

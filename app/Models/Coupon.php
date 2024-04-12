<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
            'id',
            'name',
            'coupon_code',
            'discount_amount',
            'mini_amount',
            'valid_amount',
            'valid_date',
            'status',

    ];
}

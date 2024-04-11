<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon_details extends Model
{
    use HasFactory;
    protected $table = 'Coupon_details';
    protected $fillable = [
        'id',
        'coupon_code',
        'user_id',

    ];
}

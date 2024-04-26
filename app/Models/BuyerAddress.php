<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'buyer_id',
        'name',
        'post_code',
        'prefectures',
        'city',
        'chome',
        'building',
        'room_no',
        'phone',
        'place',
        'photo',
        'created_at',
        'updated_at',

    ];
}

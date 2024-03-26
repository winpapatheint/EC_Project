<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer_addresses extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'buyer_id',
        'division',
        'district',
        'phone',
        'address',
        'post_code',
        'place',
        'photo',

    ];
}

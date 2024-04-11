<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [

        'id',

        'user_id',
        'prefecture_id',
        'bank_name',
        'bank_acc_type',
        'bank_branch',
        'bank_acc_name',
        'bank_acc_no',
        'shop_name',
        'shop_logo',
        'shop_establish',
        'phone',
        'zip_code',
        'city',
        'chome',
        'building',
        'room',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function prefecture() {
        return $this->belongsTo(Prefecture::class,'prefecture_id');
    }

}

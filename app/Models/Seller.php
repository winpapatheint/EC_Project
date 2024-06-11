<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'subseller_id',
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
        'commission',
        'coupon_status',
        'coupon_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function prefecture() {
        return $this->belongsTo(Prefecture::class,'prefecture_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function coupons()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }
}

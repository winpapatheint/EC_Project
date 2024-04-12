<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $fillable = [
       
        'user_id',
        'name',
        'email' ,
        'password',
        'address',
        'photo',
        'phone',
    ];

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}

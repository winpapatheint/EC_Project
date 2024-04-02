<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    use HasFactory;
    protected $fillable = [
    'id',
    'order_id',
    'product_id',
    'seller_id',
    'color',
    'size',
    'qty',
    'price',
    ];
}

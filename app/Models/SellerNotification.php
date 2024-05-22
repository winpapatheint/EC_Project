<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerNotification extends Model
{
    use HasFactory;
    protected $table = 'sellernotifications';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'id',
        'message',
        'time',
        'created_at',
        'updated_at',
    ];
}

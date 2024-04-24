<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'notifications';
    // Define the fillable fields for mass assignment
    protected $fillable = [
        'id',
        'message',
        'time',
        'created_at',
        'updated_at',
    ];
}

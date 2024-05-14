<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
<<<<<<< HEAD
    protected $table = 'helps';
    protected $fillable = [
        'user_id',
        'title',
        'reason',
        'img',

=======

    protected $fillable = [
        'user_id',
        'type',
        'sent',
        'notice',
        'title',
        'img',
>>>>>>> f4c0d3dbb4cd28ea174c0055c1e4f6c282e3b63e
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryTitle extends Model
{
    use HasFactory;
    protected $tables = 'sub_category_titles';

    function category() {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subCategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}

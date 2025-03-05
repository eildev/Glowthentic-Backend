<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'id');
    }

    function products()
    {
        return $this->hasMany(Product::class);
    }
}

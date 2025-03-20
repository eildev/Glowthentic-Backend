<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function parent_category()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'categoryId', 'id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function productPromotions(){
        return $this->hasMany(ProductPromotion::class, 'category_id', 'id');
    }
}

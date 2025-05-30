<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function brandProduct()
    {
        return $this->hasMany(Product::class);
    }

    function brandProductPromotion(){
        return $this->hasMany(ProductPromotion::class,'brand_id','id');
    }
}

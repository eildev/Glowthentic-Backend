<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];


    public function promotionproduct()
    {
        return $this->hasMany(ProductPromotion::class, 'promotion_id', 'id');
    }

    public function productVariantPromotion(){
        return $this->hasMany(VariantPromotion::class, 'promotion_id', 'id');
    }
}

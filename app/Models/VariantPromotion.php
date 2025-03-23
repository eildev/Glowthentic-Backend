<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantPromotion extends Model
{
    //
    protected $guarded = [];

    public function variant(){
        return $this->belongsTo(Variant::class,'variant_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class,'promotion_id','id');
    }
}

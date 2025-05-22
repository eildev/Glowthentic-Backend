<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    //

    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    

    public function feature(){
        return $this->belongsTo(Features::class, 'feature_id');
    }
}


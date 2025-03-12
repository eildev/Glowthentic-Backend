<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeManage extends Model
{
    //
    protected $guarded = [];
    public function attribute_values(){
        return $this->belongsTo(Attribute::class,'attribute_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    protected $guarded = [];
    public function attribute_manage(){
        return $this->hasMany(AttributeManage::class,'attribute_id','id');
    }
}

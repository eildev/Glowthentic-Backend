<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Features extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
  

    public function productFeatures(){
        return $this->hasMany(ProductFeature::class);
    }
}
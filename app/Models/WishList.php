<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WishList extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // function product(){
    //     return $this->belongsTo(Product::class, 'product_id', 'id');
    // }

    function wishlistProduct()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    function variant(){
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}

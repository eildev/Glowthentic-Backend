<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantImageGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

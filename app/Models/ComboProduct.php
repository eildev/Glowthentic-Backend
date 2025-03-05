<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function combo()
    {
        return $this->belongsTo(Combo::class, 'combo_id', 'id');
    }
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }
}

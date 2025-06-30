<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductConcern extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['product_id', 'concern_id'];
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function concern()
    {
        return $this->belongsTo(Concern::class);
    }
}

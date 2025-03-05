<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Tags extends Model
{
    use HasFactory, SoftDeletes;
     protected $table = 'product_tags';// Ensure this is correct
    protected $fillable = ['product_id', 'tag_id'];
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function tag()
    {
        return $this->belongsTo(TagName::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubSubcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategoryId', 'id');
    }
}

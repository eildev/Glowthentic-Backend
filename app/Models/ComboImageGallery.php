<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComboImageGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function combo()
    {
        return $this->belongsTo(Combo::class, 'combo_id', 'id');
    }
}

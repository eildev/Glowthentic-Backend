<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeBanner extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    // public function gallery()
    // {
    //     return $this->hasMany(ImageGallery::class, 'banner_id', 'id');
    // }
}

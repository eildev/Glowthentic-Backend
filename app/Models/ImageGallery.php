<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageGallery extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    function imageGalleries()
    {
        return $this->belongsTo(HomeBanner::class, 'banner_id', 'id');
    }

    function offerBanners(){
        return $this->belongsTo(OfferBanner::class, 'offer_banner_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewRating extends Model
{

    use HasFactory, SoftDeletes;
    protected $guarded = [];

    function gallery()
    {
        return $this->hasMany(ReviewImages::class, 'review_id', 'id');
    }
    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SimpleData extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'address',
        'city',
        'postal_code',
        'country',
        'image',
    ];
}

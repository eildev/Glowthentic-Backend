<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OTPData extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'o_t_p_data';

    protected $fillable = ['phone', 'email', 'otp', 'expire_at'];

    protected $casts = [
        'expire_at' => 'datetime',
    ];
}

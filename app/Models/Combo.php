<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function comboproduct()
    {
        return $this->hasMany(ComboProduct::class, 'combo_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'combo_id', 'id');
    }

    public function orderdetails()
    {
        return $this->hasMany(OrderDetails::class, 'combo_id', 'id');
    }

    public function comboimage()
    {
        return $this->hasMany(ComboImageGallery::class, 'combo_id', 'id');
    }
}

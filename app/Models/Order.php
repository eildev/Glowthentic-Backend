<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function orderBillingDetails()
    {
        return $this->belongsTo(OrderBillingDetails::class, 'id', 'order_id');
    }
    // public function orderDetails(){
    //     return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    // }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function combos()
    {
        return $this->belongsTo(User::class, 'combo_id', 'id');
    }

    public function deliveryOrder()
    {
        return $this->hasOne(DeliveryOrder::class, 'order_id', 'id');
    }
    public function reviews()
    {
        return $this->hasMany(ReviewRating::class, 'order_id', 'id');
    }
    public function userDetails()
    {
        if ($this->user_id) {
            return $this->belongsTo(UserDetails::class, 'user_id', 'user_id');
        } elseif ($this->session_id) {
            return $this->belongsTo(UserDetails::class, 'session_id', 'session_id');
        } else {
            return $this->belongsTo(UserDetails::class, 'customer_id', 'customer_id');
        }
        return null; // No user details if neither user_id nor session_id exists
    }
}

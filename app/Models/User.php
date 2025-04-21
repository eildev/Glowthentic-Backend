<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userDetails(){
        return $this->hasOne(UserDetails::class,'user_id','id');
    }

    public function billingInfo(){
        return $this->hasMany(BillingInformation::class,'user_id','id');
    }

    public function reviewRating(){
        return $this->hasMany(ReviewRating::class,'user_id','id');
    }

    // Customize the password reset notification
    public function sendPasswordResetNotification($token)
    {
        $url = env('FRONTEND_URL', 'http://127.0.0.1:5173') . '/reset-password?token=' . $token . '&email=' . urlencode($this->email);

        $this->notify(new \App\Notifications\ResetPasswordNotification($url));
    }
}

<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $timestamps = false;
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role'); // user_role == table name
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function otps()
    {
        return $this->hasMany(UserOtp::class);
    }

    public function measurements()
    {
        return $this->hasMany(Measurement::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }
}

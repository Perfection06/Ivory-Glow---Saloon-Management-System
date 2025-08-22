<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'position', 'working_days', 'profile_picture', 'active'
    ];

    protected $hidden = ['password', 'remember_token'];
    
    public function services()
    {
        return $this->hasMany(Service::class, 'staff_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
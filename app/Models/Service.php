<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'duration', 'staff_id', 'description', 'price', 'image', 'active'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
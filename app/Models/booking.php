<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'customer_id',
        'service_id',
        'staff_id',
        'appointment_date',
        'appointment_time',
        'status',
    ];

    protected $casts = [
        'appointment_date' => 'date',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}

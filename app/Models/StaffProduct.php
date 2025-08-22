<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffProduct extends Model
{
    protected $fillable = ['booking_id', 'staff_id', 'service_id', 'product_id', 'quantity', 'total_price'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
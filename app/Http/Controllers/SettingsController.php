<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Invoice;
use Illuminate\Routing\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $bookings = Booking::where('customer_id', Auth::guard('web')->id())
            ->with(['service', 'staff', 'invoice' => function ($query) {
                $query->with('staffProducts.product');
            }])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        return view('settings', compact('bookings'));
    }
}
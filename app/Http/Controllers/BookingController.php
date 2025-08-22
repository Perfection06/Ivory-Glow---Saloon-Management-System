<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Routing\Controller;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    public function showBookingForm($service_id)
    {
        $service = Service::with('staff')->findOrFail($service_id);
        $timeSlots = $this->generateTimeSlots();
        
        // Fetch bookings for the service that are pending or confirmed
        $bookedSlots = Booking::where('service_id', $service_id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->select('appointment_date', 'appointment_time')
            ->get()
            ->map(function ($booking) {
                return [
                    'date' => Carbon::parse($booking->appointment_date)->format('Y-m-d'),
                    'time' => $booking->appointment_time,
                ];
            })
            ->toArray();

        return view('book', compact('service', 'timeSlots', 'bookedSlots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|in:' . implode(',', $this->generateTimeSlots()),
        ]);

        $service = Service::with('staff')->findOrFail($validated['service_id']);
        $date = Carbon::parse($validated['appointment_date']);
        if ($date->isSunday()) {
            return back()->withErrors(['appointment_date' => 'Salon is closed on Sundays.'])->withInput();
        }

        if (!$service->staff) {
            return back()->withErrors(['service_id' => 'This service does not have a valid staff assigned. Please contact the salon.'])->withInput();
        }

        $workingDays = explode(',', str_replace(' ', '', $service->staff->working_days));
        $dayOfWeek = $date->format('D');
        if (!in_array($dayOfWeek, $workingDays)) {
            return back()->withErrors(['appointment_date' => 'The assigned staff, ' . $service->staff->name . ', is not available on this day.'])->withInput();
        }

        $conflict = Booking::where('staff_id', $service->staff_id)
            ->where('appointment_date', $validated['appointment_date'])
            ->where('appointment_time', $validated['appointment_time'])
            ->exists();
        if ($conflict) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked for ' . $service->staff->name . '.'])->withInput();
        }

        $booking = Booking::create([
            'customer_id' => Auth::guard('web')->id(),
            'service_id' => $validated['service_id'],
            'staff_id' => $service->staff_id,
            'appointment_date' => $validated['appointment_date'],
            'appointment_time' => $validated['appointment_time'],
            'status' => 'pending',
        ]);

        return redirect()->route('settings')->with('success', 'Booking created successfully!');
    }

    public function cancel(Request $request, $id)
    {
        $booking = Booking::where('customer_id', Auth::guard('web')->id())
            ->where('id', $id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->firstOrFail();

        $booking->update(['status' => 'cancelled']);

        return redirect()->route('settings')->with('success', 'Booking cancelled successfully!');
    }

    private function generateTimeSlots()
    {
        $start = Carbon::createFromTime(9, 0);
        $end = Carbon::createFromTime(19, 0);
        $slots = [];

        while ($start <= $end) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(30);
        }

        return $slots;
    }
}
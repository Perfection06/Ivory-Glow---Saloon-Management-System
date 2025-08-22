<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Service;
use App\Models\Invoice;
use App\Models\StaffProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class StaffDashboardController extends Controller
{
    public function dashboard()
    {
        $staff = Auth::guard('staff')->user();
        $today = Carbon::today()->toDateString(); 
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Existing Data
        $todayAppointments = Booking::where('staff_id', $staff->id)
            ->where('appointment_date', $today)
            ->with(['customer', 'service'])
            ->orderBy('appointment_time', 'asc')
            ->get();

        $completedAppointmentsTotal = Booking::where('staff_id', $staff->id)
            ->where('status', 'completed')
            ->count();

        $newBookings = Booking::where('staff_id', $staff->id)
            ->where('status', 'pending')
            ->count();

        // New Widgets Data
        $totalCustomers = Customer::whereIn('id', Booking::where('staff_id', $staff->id)->pluck('customer_id')->unique())->count();

        $totalStaff = 1; // Adjust if you want to show all staff count

        // Appointments by Status for Current Month
        $appointments = Booking::where('staff_id', $staff->id)
            ->whereYear('appointment_date', $currentYear)
            ->whereMonth('appointment_date', $currentMonth)
            ->select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');
        $completedAppointments = $appointments->get('completed', 0);
        $pendingAppointments = $appointments->get('pending', 0);
        $acceptedAppointments = $appointments->get('confirmed', 0);
        $cancelledAppointments = $appointments->get('cancelled', 0);

        // Income for Current Month
        $income = Invoice::whereIn('booking_id', Booking::where('staff_id', $staff->id)->pluck('id'))
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('service_price');

        // Low Stock Products
        $lowStockProducts = Product::where('quantity', '<', 15)->get(['id', 'name', 'quantity']);

        return view('staff.dashboard', compact(
            'staff',
            'todayAppointments',
            'completedAppointmentsTotal',
            'newBookings',
            'totalCustomers',
            'totalStaff',
            'completedAppointments',
            'pendingAppointments',
            'acceptedAppointments',
            'cancelledAppointments',
            'income',
            'lowStockProducts'
        ));
    }

    public function appointments()
    {
        $staff = Auth::guard('staff')->user();
        $appointments = Booking::where('staff_id', $staff->id)
            ->with(['customer', 'service', 'invoice' => function ($query) {
                $query->with('staffProducts.product');
            }])
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();

        $products = Product::all();

        return view('staff.appointments', compact('appointments', 'products'));
    }

    public function updateAppointment(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed',
        ]);

        $appointment = Booking::findOrFail($id);

        if ($appointment->staff_id !== Auth::guard('staff')->id()) {
            return redirect()->route('staff.appointments')->with('error', 'Unauthorized action.');
        }

        \DB::beginTransaction();
        try {
            $appointment->status = $request->status;

            if ($request->status === 'completed') {
                $service = Service::find($appointment->service_id);
                if (!$service) {
                    throw new \Exception('Service not found for this booking.');
                }

                // Create invoice with all required foreign keys
                $invoice = Invoice::create([
                    'booking_id' => $appointment->id,
                    'customer_id' => $appointment->customer_id,
                    'service_id' => $appointment->service_id,
                    'staff_id' => $appointment->staff_id,
                    'service_price' => $service->price,
                ]);

                // Update product quantities if any
                $products = StaffProduct::where('booking_id', $appointment->id)->get();
                foreach ($products as $product) {
                    $inventory = Product::find($product->product_id);
                    if (!$inventory) {
                        throw new \Exception("Product with ID {$product->product_id} not found.");
                    }
                    if ($inventory->quantity < $product->quantity) {
                        throw new \Exception("Insufficient quantity for product {$inventory->name}.");
                    }
                    $inventory->quantity -= $product->quantity;
                    $inventory->save();
                }
            }

            $appointment->save();
            \DB::commit();

            return redirect()->route('staff.appointments')->with('success', 'Appointment status updated successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            Log::error('Failed to update appointment status: ' . $e->getMessage());
            return redirect()->route('staff.appointments')->with('error', 'Failed to update appointment status: ' . $e->getMessage());
        }
    }

    public function cancelAppointment($id)
    {
        $appointment = Booking::findOrFail($id);

        if ($appointment->staff_id !== Auth::guard('staff')->id()) {
            return redirect()->route('staff.appointments')->with('error', 'Unauthorized action.');
        }

        $appointment->status = 'cancelled';
        $appointment->save();

        return redirect()->route('staff.appointments')->with('success', 'Appointment cancelled successfully.');
    }

    public function storeProducts(Request $request, $id)
    {
        $appointment = Booking::findOrFail($id);

        if ($appointment->staff_id !== Auth::guard('staff')->id()) {
            return redirect()->route('staff.appointments')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'products' => 'required|array',
            'products.*' => 'integer|min:0',
        ]);

        \DB::beginTransaction();
        try {
            // Validate booking relationships
            if (!$appointment->service_id || !Service::find($appointment->service_id)) {
                throw new \Exception('Invalid or missing service for this booking.');
            }
            if (!$appointment->staff_id || !Staff::find($appointment->staff_id)) {
                throw new \Exception('Invalid or missing staff for this booking.');
            }

            foreach ($request->products as $productId => $quantity) {
                if ($quantity > 0) {
                    $product = Product::findOrFail($productId);
                    if ($product->quantity < $quantity) {
                        throw new \Exception("Not enough {$product->name} in stock. Available: {$product->quantity}");
                    }

                    StaffProduct::updateOrCreate(
                        [
                            'booking_id' => $appointment->id,
                            'product_id' => $productId,
                        ],
                        [
                            'staff_id' => $appointment->staff_id,
                            'service_id' => $appointment->service_id,
                            'quantity' => $quantity,
                            'total_price' => $product->unit_price * $quantity,
                        ]
                    );
                }
            }
            \DB::commit();
            return redirect()->route('staff.appointments')->with('success', 'Products assigned successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Failed to assign products for booking ID ' . $id . ': ' . $e->getMessage());
            return redirect()->route('staff.appointments')->with('error', 'Failed to assign products: ' . $e->getMessage());
        }
    }

    public function customers()
    {
        $staff = Auth::guard('staff')->user();
        $customers = Customer::whereIn('id', Booking::where('staff_id', $staff->id)
            ->pluck('customer_id')
            ->unique())
            ->get(['id', 'name', 'email', 'phone_number']);

        return view('staff.customers', compact('customers'));
    }

    public function profile()
    {
        $staff = Auth::guard('staff')->user();
        return view('staff.profile', compact('staff'));
    }

    public function updateProfile(Request $request)
    {
        $staff = Auth::guard('staff')->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'working_days' => 'nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'password' => 'nullable|string|confirmed',
        ]);

        $data = $request->only(['name', 'phone', 'position', 'working_days']);

        if ($request->hasFile('profile_picture')) {
            if ($staff->profile_picture && Storage::disk('public')->exists($staff->profile_picture)) {
                Storage::disk('public')->delete($staff->profile_picture);
            }
            $path = $request->file('profile_picture')->store('staff_profiles', 'public');
            $data['profile_picture'] = $path;
        }

        if ($request->filled('password') && $request->password === $request->password_confirmation) {
            $data['password'] = Hash::make($request->password);
        } elseif ($request->filled('password') && $request->password !== $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password and confirmation do not match.');
        }

        $staff->update($data);

        return redirect()->route('staff.profile')->with('success', 'Profile updated successfully!');
    }
}
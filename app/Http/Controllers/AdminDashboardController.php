<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Shop;
use App\Models\Message;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $appointments = Booking::with(['customer', 'service', 'staff', 'invoice' => function ($query) {
            $query->with('staffProducts.product');
        }])->orderBy('appointment_date', 'desc')->orderBy('appointment_time', 'desc')->get();

        return view('admin.appointments', compact('appointments'));
    }

    public function customers()
    {
        $customers = Customer::with('bookings.service')->get();
        return view('admin.customers', compact('customers'));
    }

    public function reports()
    {
        $services = Service::all();
        $staff = Staff::all();
        $bookings = Booking::with('service', 'staff')->get();
        
        $period = request('period', 'daily');
        $staffId = request('staff_id');
        $serviceId = request('service_id');
        $date = request('date');

        $filteredBookings = $bookings;
        if ($staffId) $filteredBookings = $filteredBookings->where('staff_id', $staffId);
        if ($serviceId) $filteredBookings = $filteredBookings->where('service_id', $serviceId);
        if ($date) $filteredBookings = $filteredBookings->where('appointment_date', $date);

        $stats = $this->calculateStats($filteredBookings, $period);
        $topServices = $this->getTopServices($filteredBookings);
        $topStaff = $this->getTopStaff($filteredBookings);

        return view('admin.reports', compact('stats', 'topServices', 'topStaff', 'services', 'staff'));
    }

    public function export(Request $request)
    {
        $format = $request->query('format', 'csv');
        
        if ($format !== 'csv') {
            return redirect()->route('admin.reports.index')->with('error', 'Invalid export format.');
        }

        $services = Service::all();
        $staff = Staff::all();
        $bookings = Booking::with('service', 'staff')->get();
        
        $period = $request->query('period', 'daily');
        $staffId = $request->query('staff_id');
        $serviceId = $request->query('service_id');
        $date = $request->query('date');

        $filteredBookings = $bookings;
        if ($staffId) $filteredBookings = $filteredBookings->where('staff_id', $staffId);
        if ($serviceId) $filteredBookings = $filteredBookings->where('service_id', $serviceId);
        if ($date) $filteredBookings = $filteredBookings->where('appointment_date', $date);

        $stats = $this->calculateStats($filteredBookings, $period);
        $topServices = $this->getTopServices($filteredBookings);
        $topStaff = $this->getTopStaff($filteredBookings);

        // Generate CSV
        $filename = 'salonpro_report_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $output = fopen('php://output', 'w');
        fputcsv($output, ['SalonPro Report', now()->format('Y-m-d H:i:s')]);
        fputcsv($output, []);

        // Appointment Stats
        fputcsv($output, ['Appointment Statistics (' . $period . ')']);
        fputcsv($output, ['Total Appointments', $stats]);
        fputcsv($output, []);

        // Top Services
        fputcsv($output, ['Top 5 Services']);
        fputcsv($output, ['Service Name', 'Appointments']);
        if ($topServices->isNotEmpty()) {
            foreach ($topServices as $service) {
                fputcsv($output, [$service->name, $service->count]);
            }
        } else {
            fputcsv($output, ['No data available']);
        }
        fputcsv($output, []);

        // Top Staff
        fputcsv($output, ['Top 5 Staff']);
        fputcsv($output, ['Staff Name', 'Appointments']);
        if ($topStaff->isNotEmpty()) {
            foreach ($topStaff as $staffMember) {
                fputcsv($output, [$staffMember->name, $staffMember->count]);
            }
        } else {
            fputcsv($output, ['No data available']);
        }

        fclose($output);
        return Response::make('', 200, $headers);
    }

    public function dashboard()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Total Customers
        $totalCustomers = Customer::count();

        // Total Staff
        $totalStaff = Staff::where('active', true)->count();

        // Appointments by Status for Current Month
        $appointments = Booking::whereYear('appointment_date', $currentYear)
            ->whereMonth('appointment_date', $currentMonth)
            ->select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');
        $completedAppointments = $appointments->get('completed', 0);
        $pendingAppointments = $appointments->get('pending', 0);
        $acceptedAppointments = $appointments->get('confirmed', 0);
        $cancelledAppointments = $appointments->get('cancelled', 0);

        // Income for Current Month
        $income = Invoice::whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->sum('service_price');

        // Low Stock Products (qty < 15)
        $lowStockProducts = Product::where('quantity', '<', 15)->get(['id', 'name', 'quantity']);

        return view('admin.dashboard', compact(
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

    public function settings()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.settings', compact('admin'));
    }

    public function updateSettings(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        $request->validate([
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|confirmed',
        ]);

        $data = $request->only(['email']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }

    private function calculateStats($bookings, $period)
    {
        $now = now();
        $stats = ['daily' => 0, 'weekly' => 0, 'monthly' => 0];

        foreach ($bookings as $booking) {
            $date = \Carbon\Carbon::parse($booking->appointment_date);
            if ($period === 'daily' && $date->isSameDay($now)) {
                $stats['daily']++;
            } elseif ($period === 'weekly' && $date->between($now->startOfWeek(), $now->endOfWeek())) {
                $stats['weekly']++;
            } elseif ($period === 'monthly' && $date->month === $now->month) {
                $stats['monthly']++;
            }
        }

        return $stats[$period];
    }

    private function getTopServices($bookings, $limit = 5)
    {
        $serviceCounts = $bookings->groupBy('service_id')->map->count();
        return Service::whereIn('id', $serviceCounts->keys())
            ->get()
            ->map(function ($service) use ($serviceCounts) {
                $service->count = $serviceCounts[$service->id];
                return $service;
            })
            ->sortByDesc('count')
            ->take($limit);
    }

    private function getTopStaff($bookings, $limit = 5)
    {
        $staffCounts = $bookings->groupBy('staff_id')->map->count();
        return Staff::whereIn('id', $staffCounts->keys())
            ->get()
            ->map(function ($staff) use ($staffCounts) {
                $staff->count = $staffCounts[$staff->id];
                return $staff;
            })
            ->sortByDesc('count')
            ->take($limit);
    }

    public function messages()
    {
        try {
            $messages = Message::all(); // Fetch all messages
            return view('admin.messages', compact('messages'));
        } catch (\Exception $e) {
            \Log::error('AdminDashboardController::messages failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to load messages. Please try again.']);
        }
    }

    public function shopDetails()
    {
        try {
            $shop = Shop::first();
            return view('admin.shop-details', compact('shop'));
        } catch (\Exception $e) {
            \Log::error('AdminDashboardController::shopDetails failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to load shop details. Please try again.']);
        }
    }

    public function updateShopDetails(Request $request)
    {
        try {
            $validated = $request->validate([
                'address' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'facebook_url' => 'nullable|url|max:255',
                'instagram_url' => 'nullable|url|max:255',
                'twitter_url' => 'nullable|url|max:255',
                'map_embed_url' => 'nullable|string',
            ]);

            // Combine start_time and end_time into opening_hours
            $opening_hours = date('h:i A', strtotime($validated['start_time'])) . ' - ' . date('h:i A', strtotime($validated['end_time']));
            $validated['opening_hours'] = $opening_hours;
            unset($validated['start_time'], $validated['end_time']);

            $shop = Shop::first();
            if ($shop) {
                $shop->update($validated);
            } else {
                Shop::create($validated);
            }

            \Log::info('Shop details updated', $validated);

            return redirect()->route('admin.shop-details')->with('success', 'Shop details updated successfully!');
        } catch (\Exception $e) {
            \Log::error('AdminDashboardController::updateShopDetails failed: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to update shop details. Please try again.']);
        }
    }
}
?>
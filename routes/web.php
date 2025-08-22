<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ContactController;
use App\Models\Shop; 

// Root route
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Customer routes
Route::get('/register', [CustomerController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [CustomerController::class, 'register'])->name('register.store');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware('auth:web')->group(function () {
    Route::get('/book/{service_id}', [BookingController::class, 'showBookingForm'])->name('book');
    Route::post('/book', [BookingController::class, 'store'])->name('book.store');
    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
});

// Staff routes
Route::prefix('staff')->group(function () {
    Route::get('/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
    Route::post('/login', [StaffAuthController::class, 'login'])->name('staff.login.submit');
    Route::post('/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
    Route::middleware('auth:staff')->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'dashboard'])->name('staff.dashboard');
        Route::get('/appointments', [StaffDashboardController::class, 'appointments'])->name('staff.appointments');
        Route::post('/appointments/{id}/products', [StaffDashboardController::class, 'storeProducts'])->name('staff.appointments.products');
        Route::get('/customers', [StaffDashboardController::class, 'customers'])->name('staff.customers');
        Route::match(['get', 'post'], '/customers/notes/{bookingId}', [StaffDashboardController::class, 'customerNotes'])->name('staff.customers.notes');
        Route::patch('/appointments/{id}', [StaffDashboardController::class, 'updateAppointment'])->name('staff.appointments.update');
        Route::patch('/appointments/{id}/cancel', [StaffDashboardController::class, 'cancelAppointment'])->name('staff.appointments.cancel');
        Route::get('/profile', [StaffDashboardController::class, 'profile'])->name('staff.profile');
        Route::post('/profile', [StaffDashboardController::class, 'updateProfile'])->name('staff.profile.update');
    });
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    })->name('admin.logout');
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/appointments', [AdminDashboardController::class, 'index'])->name('admin.appointments.index');
        Route::get('/customers', [AdminDashboardController::class, 'customers'])->name('admin.customers.index');
        Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('admin.reports.index');
        Route::get('/reports/export', [AdminDashboardController::class, 'export'])->name('admin.reports.export');
        Route::get('/reports/download-pdf', [AdminDashboardController::class, 'downloadPdf'])->name('admin.reports.download-pdf');
        Route::get('/settings', [AdminDashboardController::class, 'settings'])->name('admin.settings');
        Route::put('/settings', [AdminDashboardController::class, 'updateSettings'])->name('admin.settings.update');
        Route::get('/messages', [AdminDashboardController::class, 'messages'])->name('admin.messages');
        Route::get('/shop-details', [AdminDashboardController::class, 'shopDetails'])->name('admin.shop-details');
        Route::put('/shop-details', [AdminDashboardController::class, 'updateShopDetails'])->name('admin.shop-details.update');

        // Staff Management
        Route::get('/ViewStaff', [StaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/AddStaff', [StaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');
        Route::patch('/staff/{id}/toggle', [StaffController::class, 'toggle'])->name('staff.toggle');
        Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

        // Service Management
        Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('service.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('service.update');
        Route::patch('/services/{id}/toggle', [ServiceController::class, 'toggle'])->name('service.toggle');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

        // Product Management
        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::post('/products', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    });
});
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Shop;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('active', true)->get();
        $staff = Staff::where('active', true)->get();
        $positions = Staff::where('active', true)->distinct()->pluck('position')->toArray();
        $shop = Shop::first();
        return view('index', compact('services', 'staff', 'positions', 'shop'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string',
            'nic' => 'required|string|max:20|unique:customers',
            'password' => 'required|string|confirmed',
        ]);

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'nic' => $request->nic,
            'password' => $request->password, // Automatically hashed via model
        ]);

        return redirect()->route('home')->with('success', 'Account Created successfully!');
    }
}

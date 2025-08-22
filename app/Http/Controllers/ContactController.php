<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        $shop = Shop::first();
        return view('index', compact('shop')); // Changed from 'contact' to 'index'
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Save the message to the database
        Message::create($validated);

        // Optionally send an email (if configured)
        // Mail::to('admin@salonpro.com')->send(new \App\Mail\ContactMessage($validated));

        return redirect()->route('home')->with('success', 'Your message has been sent successfully!');
    }
}
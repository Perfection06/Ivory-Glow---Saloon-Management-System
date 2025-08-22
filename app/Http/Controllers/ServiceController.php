<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('staff')->get();
        return view('admin.ViewService', compact('services'));
    }

    public function create()
    {
        $staff = Staff::where('active', true)->get();
        return view('admin.AddService', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|in:Haircut,Hair Styling,Blowout,Updo,Hair Coloring,Perm,Hair Straightening,Men’s Haircut,Beard Trim,Shave,Fade,Highlights,Balayage,Ombre,Makeup Application,Eyebrow Shaping,Eyelash Extensions,Facial,Microdermabrasion,Chemical Peel,Waxing,Swedish Massage,Deep Tissue Massage,Hot Stone Massage,Aromatherapy,Manicure,Pedicure,Nail Art,Gel Nails',
            'duration' => 'required|integer|min:1',
            'staff_id' => 'required|exists:staff,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $serviceData = [
            'name' => $request->name,
            'duration' => $request->duration,
            'staff_id' => $request->staff_id,
            'description' => $request->description,
            'price' => $request->price,
            'active' => true,
            'image' => 'images/barber.jpg', // Set default image
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('services', 'public');
            $serviceData['image'] = $imagePath;
        }

        Service::create($serviceData);

        return redirect()->route('service.index')->with('success', 'Service added successfully!');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $staff = Staff::where('active', true)->get();
        return view('admin.EditService', compact('service', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|in:Haircut,Hair Styling,Blowout,Updo,Hair Coloring,Perm,Hair Straightening,Men’s Haircut,Beard Trim,Shave,Fade,Highlights,Balayage,Ombre,Makeup Application,Eyebrow Shaping,Eyelash Extensions,Facial,Microdermabrasion,Chemical Peel,Waxing,Swedish Massage,Deep Tissue Massage,Hot Stone Massage,Aromatherapy,Manicure,Pedicure,Nail Art,Gel Nails',
            'duration' => 'required|integer|min:1',
            'staff_id' => 'required|exists:staff,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $serviceData = [
            'name' => $request->name,
            'duration' => $request->duration,
            'staff_id' => $request->staff_id,
            'description' => $request->description,
            'price' => $request->price,
            'active' => true,
            'image' => $service->image ?: 'images/barber.jpg', // Retain existing or set default
        ];

        if ($request->hasFile('image')) {
            if ($service->image && $service->image !== 'images/barber.jpg') {
                Storage::disk('public')->delete($service->image);
            }
            $imagePath = $request->file('image')->store('services', 'public');
            $serviceData['image'] = $imagePath;
        }

        $service->update($serviceData);

        return redirect()->route('service.index')->with('success', 'Service updated successfully!');
    }

    public function toggle($id)
    {
        $service = Service::findOrFail($id);
        $service->update(['active' => !$service->active]);

        return redirect()->route('service.index')->with('success', 'Service status updated successfully!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        if ($service->image && $service->image !== 'images/barber.jpg') {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('service.index')->with('success', 'Service deleted successfully!');
    }
}
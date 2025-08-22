<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::all();
        return view('admin.ViewStaff', compact('staff')); 
    }

    public function create()
    {
        return view('admin.AddStaff'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|string',
            'phone' => 'required|string|max:20',
            'working_days' => 'required|array|min:1',
            'working_days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'position' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staffData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'position' => $request->position,
            'working_days' => implode(',', $request->working_days),
            'active' => true,
            'profile_picture' => 'images/default.jpg', // Set default image
        ];

        if ($request->hasFile('profile_picture')) {
            $imagePath = $request->file('profile_picture')->store('staff', 'public');
            $staffData['profile_picture'] = $imagePath;
        }

        Staff::create($staffData);

        return redirect()->route('staff.index')->with('success', 'Staff added successfully!');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('admin.EditStaff', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $id,
            'phone' => 'required|string|max:20',
            'position' => 'required|string|max:255',
            'working_days' => 'required|array|min:1',
            'working_days.*' => 'in:Mon,Tue,Wed,Thu,Fri,Sat,Sun',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $staffData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position' => $request->position,
            'working_days' => implode(',', $request->working_days),
            'profile_picture' => $staff->profile_picture ?: 'images/default.jpg', // Retain existing or set default
        ];

        if ($request->filled('password')) {
            $staffData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($staff->profile_picture && $staff->profile_picture !== 'images/default.jpg') {
                Storage::disk('public')->delete($staff->profile_picture);
            }
            $imagePath = $request->file('profile_picture')->store('staff', 'public');
            $staffData['profile_picture'] = $imagePath;
        }

        $staff->update($staffData);

        return redirect()->route('staff.index')->with('success', 'Staff updated successfully!');
    }

    public function toggle($id)
    {
        $staff = Staff::findOrFail($id);
        $staff->active = !$staff->active;
        $staff->save();

        return redirect()->route('staff.index')->with('success', 'Staff status updated successfully!');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);
        if ($staff->profile_picture && $staff->profile_picture !== 'images/default.jpg') {
            Storage::disk('public')->delete($staff->profile_picture);
        }
        $staff->delete();

        return redirect()->route('staff.index')->with('success', 'Staff deleted successfully!');
    }
}
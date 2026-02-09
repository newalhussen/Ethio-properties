<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Car;
use Illuminate\Http\Request;

class ModerationController extends Controller
{
    public function dashboard()
    {
        $pendingHouses = House::where('status', 'pending')->get();
        $pendingCars = Car::where('status', 'pending')->get();
        
        return view('admin.moderation.dashboard', compact('pendingHouses', 'pendingCars'));
    }

    public function approveHouse(House $house)
    {
        $house->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        return back()->with('success', 'House approved successfully');
    }

    public function rejectHouse(Request $request, House $house)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $house->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'House rejected');
    }

    public function approveCar(Car $car)
    {
        $car->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        return back()->with('success', 'Car approved successfully');
    }

    public function rejectCar(Request $request, Car $car)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $car->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason
        ]);

        return back()->with('success', 'Car rejected');
    }
}

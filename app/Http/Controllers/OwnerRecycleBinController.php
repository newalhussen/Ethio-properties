<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OwnerRecycleBinController extends Controller
{
public function index()
{
    $userId = auth()->id();

    // Fetch deleted houses
    $houses = House::onlyTrashed()
        ->where('user_id', $userId)
        ->get()
        ->map(function ($item) {
            $item->type = 'house';
            return $item;
        });

    // Fetch deleted cars
    $cars = Car::onlyTrashed()
        ->where('user_id', $userId)
        ->get()
        ->map(function ($item) {
            $item->type = 'car';
            return $item;
        });

    // Merge into one collection + sort by deleted date
    $items = $houses->merge($cars)->sortByDesc('deleted_at');

    return view('owner.recycle-bin', compact('items'));
}


    public function restoreHouse($id)
    {
        $house = House::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $house->restore();

        return back()->with('success', '🏠 House restored successfully.');
    }

    public function forceDeleteHouse($id)
    {
        $house = House::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if (!empty($house->images)) {
            foreach ($house->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        $house->forceDelete();

        return back()->with('success', '❌ House permanently deleted.');
    }

    public function restoreCar($id)
    {
        $car = Car::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $car->restore();

        return back()->with('success', '🚗 Car restored successfully.');
    }

    public function forceDeleteCar($id)
    {
        $car = Car::onlyTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if (!empty($car->images)) {
            foreach ($car->images as $img) {
                if (Storage::disk('public')->exists($img)) {
                    Storage::disk('public')->delete($img);
                }
            }
        }

        if (!empty($car->video) && Storage::disk('public')->exists($car->video)) {
            Storage::disk('public')->delete($car->video);
        }

        $car->forceDelete();

        return back()->with('success', '❌ Car permanently deleted.');
    }
}

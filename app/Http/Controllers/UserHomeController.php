<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Car;
use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function index()
    {
        // Popular (Featured)
        $popularCars = Car::approved()
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $popularHouses = House::approved()
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        // New (Latest)
        $newCars = Car::approved()
            ->latest()
            ->take(6)
            ->get();

        $newHouses = House::approved()
            ->latest()
            ->take(6)
            ->get();

        return view('user.home', compact(
            'popularCars',
            'popularHouses',
            'newCars',
            'newHouses'
        ));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\House;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim($request->get('q'));

        // ===== SEARCH CARS =====
        $cars = Car::approved()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('brand', 'like', "%{$q}%")
                      ->orWhere('model', 'like', "%{$q}%")
                      ->orWhere('body_type', 'like', "%{$q}%")
                      ->orWhere('transmission', 'like', "%{$q}%")
                       ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('description_am', 'like', "%{$q}%")
                      ->orWhere('drive_type', 'like', "%{$q}%")
                      ->orWhere('fuel', 'like', "%{$q}%") // replaced engine_type with fuel
                      ->orWhere('engine_size', 'like', "%{$q}%")
                      ->orWhere('color', 'like', "%{$q}%")
                      ->orWhere('condition', 'like', "%{$q}%");

                if (is_numeric($q)) {
                    $query->orWhere('price', 'like', "%{$q}%")
                          ->orWhere('year', 'like', "%{$q}%")
                          ->orWhere('mileage', 'like', "%{$q}%");
                }
            })
            ->latest()
            ->take(20)
            ->get();

        // ===== SEARCH HOUSES =====
        $houses = House::approved()
            ->where(function ($query) use ($q) {
                $query->where('title_en', 'like', "%{$q}%")
                      ->orWhere('title_am', 'like', "%{$q}%")
                      ->orWhere('description_en', 'like', "%{$q}%")
                      ->orWhere('description_am', 'like', "%{$q}%")
                      ->orWhere('region', 'like', "%{$q}%")
                      ->orWhere('city_en', 'like', "%{$q}%")
                      ->orWhere('city_am', 'like', "%{$q}%")
                      ->orWhere('subcity_en', 'like', "%{$q}%")
                      ->orWhere('subcity_am', 'like', "%{$q}%");

                if (is_numeric($q)) {
                    $query->orWhere('price', 'like', "%{$q}%")
                          ->orWhere('built_year', 'like', "%{$q}%");
                }
            })
            ->latest()
            ->take(20)
            ->get();

        return view('search.results', compact('q', 'cars', 'houses'));
    }

    public function suggest(Request $request)
    {
        $q = trim($request->get('q'));

        if (strlen($q) < 2) {
            return response()->json([]);
        }

        // ===== SUGGEST CARS =====
        $cars = Car::approved()
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                      ->orWhere('brand', 'like', "%{$q}%")
                      ->orWhere('model', 'like', "%{$q}%")
                      ->orWhere('body_type', 'like', "%{$q}%")
                      ->orWhere('transmission', 'like', "%{$q}%")
                      ->orWhere('drive_type', 'like', "%{$q}%")
                      ->orWhere('description', 'like', "%{$q}%")
                      ->orWhere('description_am', 'like', "%{$q}%")
                      ->orWhere('fuel', 'like', "%{$q}%") // replaced engine_type with fuel
                      ->orWhere('engine_size', 'like', "%{$q}%")
                      ->orWhere('color', 'like', "%{$q}%")
                      ->orWhere('condition', 'like', "%{$q}%");

                if (is_numeric($q)) {
                    $query->orWhere('price', 'like', "%{$q}%")
                          ->orWhere('year', 'like', "%{$q}%")
                          ->orWhere('mileage', 'like', "%{$q}%");
                }
            })
            ->take(5)
            ->get()
            ->map(fn($c) => [
                'type'  => 'car',
                'title' => $c->title,
                'url'   => route('user.cars.show', $c->id),
            ]);

        // ===== SUGGEST HOUSES =====
        $houses = House::approved()
            ->where(function ($query) use ($q) {
                $query->where('title_en', 'like', "%{$q}%")
                      ->orWhere('title_am', 'like', "%{$q}%")
                      ->orWhere('description_en', 'like', "%{$q}%")
                      ->orWhere('description_am', 'like', "%{$q}%")
                      ->orWhere('region', 'like', "%{$q}%")
                      ->orWhere('city_en', 'like', "%{$q}%")
                      ->orWhere('city_am', 'like', "%{$q}%")
                      ->orWhere('subcity_en', 'like', "%{$q}%")
                      ->orWhere('subcity_am', 'like', "%{$q}%");

                if (is_numeric($q)) {
                    $query->orWhere('price', 'like', "%{$q}%")
                          ->orWhere('built_year', 'like', "%{$q}%");
                }
            })
            ->take(5)
            ->get()
            ->map(fn($h) => [
                'type'  => 'house',
                'title' => $h->title,
                'url'   => route('houses.show', $h->id),
            ]);

        return response()->json(
            $cars->merge($houses)->values()
        );
    }
}

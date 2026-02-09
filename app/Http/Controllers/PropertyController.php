<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // Show form to create a new car property
    public function create()
    {
        return view('owner.properties.create');
    }

    // Store property + car in database
    public function store(Request $request)
    {
        $request->validate([
            'title_en' => 'required|string|max:255',
            'title_am' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_am' => 'nullable|string',
            'price' => 'nullable|numeric',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'main_image' => 'nullable|image|max:2048',
            'brand' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'transmission' => 'required|string',
            'body_type' => 'required|string',
            'color' => 'required|string',
            'fuel' => 'required|string',
            'engine_size' => 'required|string',
            'mileage' => 'required|integer',
        ]);

        // Handle main image upload
        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('properties', 'public');
        }

        // Create property with JSON multilingual fields
        $property = Property::create([
            'user_id' => Auth::id() ?? 1, // default user id 1 for now
            'type' => 'car',
            'transaction' => 'sell',
            'price' => $request->price,
            'city' => $request->city,
            'address' => $request->address,
            'main_image' => $imagePath,
            'title' => json_encode([
                'en' => $request->title_en,
                'am' => $request->title_am
            ]),
            'description' => json_encode([
                'en' => $request->description_en,
                'am' => $request->description_am
            ]),
            'is_published' => true,
        ]);

        // Create linked car
        $property->car()->create([
            'brand' => $request->brand,
            'model' => $request->model,
            'year' => $request->year,
            'transmission' => $request->transmission,
            'body_type' => $request->body_type,
            'color' => $request->color,
            'fuel' => $request->fuel,
            'engine_size' => $request->engine_size,
            'mileage' => $request->mileage,
        ]);

        return redirect()->back()->with('success', 'Car property posted successfully!');
    }

    // Show home page with all car properties
public function index()
{
    $properties = \App\Models\Property::with('car')
        ->where('type', 'car')
        ->where('is_published', true)
        ->latest()
        ->get();

    return view('user.home', compact('properties'));
}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index()
    {
        // Get all cars with owner info
        $cars = Car::with('owner')->latest()->paginate(15);

        return view('admin.cars.index', compact('cars'));
    }

public function show($id)
{
    $car = Car::with('owner')->findOrFail($id);

    // Decode images array
    $images = [];
    if (!empty($car->images)) {
        if (is_array($car->images)) {
            $images = $car->images;
        } else {
            $decoded = json_decode($car->images, true);
            $images = is_array($decoded) ? $decoded : [];
        }
    }

    return view('admin.cars.show', compact('car', 'images'));
}


    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }

public function approve($id)
{
    $car = Car::findOrFail($id);
    $car->status = 'approved';
    $car->approved_at = now();
    $car->approved_by = auth()->id();
    $car->rejection_reason = null;
    $car->save();

    return response()->json(['message' => 'Car approved successfully']);
}

public function reject(Request $request, $id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000',
    ]);

    $car = Car::findOrFail($id);
    $car->status = 'rejected';
    $car->rejection_reason = $request->rejection_reason;
    $car->approved_at = null;
    $car->approved_by = null;
    $car->save();

    return response()->json(['message' => 'Car rejected successfully']);
}
public function pending()
{
    $cars = Car::with('owner')
        ->where('status', 'pending')
        ->latest()
        ->paginate(15);

    return view('admin.cars.pending', compact('cars'));
}

public function approved()
{
    $cars = Car::with('owner')
        ->where('status', 'approved')
        ->latest()
        ->paginate(15);

    return view('admin.cars.approved', compact('cars'));
}

public function rejected()
{
    $cars = Car::with('owner')
        ->where('status', 'rejected')
        ->latest()
        ->paginate(15);

    return view('admin.cars.rejected', compact('cars'));
}

public function edit($id)
{
    $car = Car::findOrFail($id);
    return view('admin.cars.edit', compact('car'));
}

public function update(Request $request, $id)
{
    $car = Car::findOrFail($id);

    $data = $request->only([
        'brand', 'model', 'title', 'title_am', 'description', 'description_am',
        'year', 'transmission', 'body_type', 'color', 'fuel', 'engine_size',
        'seats', 'doors', 'drive_type', 'condition', 'mileage', 'price',
        'seller_name', 'seller_type', 'contact_phone', 'contact_email',
        'seller_address', 'sale_rent', 'price_type',
    ]);

    $oldImages = $car->images ?? [];
    $oldVideo = $car->video;

    if ($request->hasFile('images')) {
        $paths = [];
        foreach ($request->file('images') as $img) {
            $paths[] = $img->store('cars/images', 'public');
        }
        $data['images'] = $paths;
    }

    if ($request->hasFile('video')) {
        $data['video'] = $request->file('video')->store('cars/videos', 'public');
    }

    $car->update($data);

    if ($request->hasFile('images')) {
        foreach ($oldImages as $oldImg) {
            if (Storage::disk('public')->exists($oldImg)) {
                Storage::disk('public')->delete($oldImg);
            }
        }
    }

    if ($request->hasFile('video') && !empty($oldVideo) && Storage::disk('public')->exists($oldVideo)) {
        Storage::disk('public')->delete($oldVideo);
    }

    return redirect()
        ->route('admin.cars.show', $car->id)
        ->with('success', 'Car updated successfully!');
}

public function toggleFeatured(Request $request, Car $car)
{
    $car->is_featured = !$car->is_featured;
    $car->save();

    return response()->json([
        'message' => $car->is_featured 
            ? 'Car marked as featured successfully!' 
            : 'Car unmarked as featured successfully!'
    ]);
}

}

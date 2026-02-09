<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    /**
     * Display a listing of cars with filters.
     */
    public function index(Request $request)
{
    $query = Car::query();

    // Only show cars approved by admin
    $query->where('status', 'approved');

    // Filter by sale/rent
    if ($request->has('sale_rent') && in_array($request->sale_rent, ['sale', 'rent'])) {
        $query->where('sale_rent', $request->sale_rent);
    }

    // Filter by seller type
    if ($request->filled('seller_type')) {
        $query->where('seller_type', $request->seller_type);
    }

    // Filter by brand (fix the field name)
    if ($request->filled('brand')) {
        $query->where('brand', $request->brand);
    }

    // Filter by make (alias for brand)
    if ($request->filled('make')) {
        $query->where('brand', $request->make);
    }

    // Filter by model
    if ($request->filled('model')) {
        $query->where('model', 'like', "%{$request->model}%");
    }

    // Filter by color
    if ($request->filled('color')) {
        $query->where('color', $request->color);
    }

    // Filter by fuel
    if ($request->filled('fuel')) {
        $query->where('fuel', $request->fuel);
    }

    // Filter by transmission
    if ($request->filled('transmission')) {
        $query->where('transmission', $request->transmission);
    }

    // Filter by body type
    if ($request->filled('body_type')) {
        $query->where('body_type', $request->body_type);
    }

    // Filter by year range
    if ($request->filled('year_min')) {
        $query->where('year', '>=', $request->year_min);
    }
    if ($request->filled('year_max')) {
        $query->where('year', '<=', $request->year_max);
    }

    // Filter by mileage range (fix the field name)
    if ($request->filled('mileage')) {
        $query->where('mileage', '<=', $request->mileage);
    }

    // Filter by engine size
    if ($request->filled('engine_size')) {
        $query->where('engine_size', 'like', "%{$request->engine_size}%");
    }

    // Filter by price range
    if ($request->filled('price_min')) {
        $query->where('price', '>=', $request->price_min);
    }
    if ($request->filled('price_max')) {
        $query->where('price', '<=', $request->price_max);
    }

    // Filter by drive type
    if ($request->filled('drive_type')) {
        $query->where('drive_type', $request->drive_type);
    }

    // Filter by condition
    if ($request->filled('condition')) {
        $query->where('condition', $request->condition);
    }

    // Keyword search (brand, model, description)
    if ($request->filled('q')) {
        $keyword = $request->q;
        $query->where(function ($q) use ($keyword) {
            $q->where('brand', 'like', "%$keyword%")
              ->orWhere('model', 'like', "%$keyword%")
              ->orWhere('description', 'like', "%$keyword%");
        });
    }

    // Pagination with query string
    $cars = $query->latest()->paginate(12)->withQueryString();

    // Prepare cars for JavaScript (copying house logic exactly)
    $carsForJS = $cars->map(function($car){
        // Normalize images to an array of URLs (supports storage and public paths)
        $rawImages = [];
        if (!empty($car->images) && is_array($car->images)) {
            $rawImages = $car->images;
        } elseif (!empty($car->images) && !is_array($car->images)) {
            $decoded = json_decode($car->images, true);
            $rawImages = is_array($decoded) ? $decoded : [];
        }

        $imageUrls = [];
        foreach ($rawImages as $p) {
            if (empty($p)) continue;
            $path = ltrim($p, '/');
            // If already absolute URL
            if (preg_match('/^https?:\/\//i', $path)) {
                $imageUrls[] = $path;
                continue;
            }
            // storage: public disk (requires storage:link)
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $imageUrls[] = asset('storage/' . $path);
                continue;
            }
            // public path direct
            if (file_exists(public_path($path))) {
                $imageUrls[] = asset($path);
                continue;
            }
            // public/uploads fallback
            if (file_exists(public_path('uploads/' . $path))) {
                $imageUrls[] = asset('uploads/' . $path);
                continue;
            }
        }

        return [
            'id' => $car->id,
            'brand' => $car->brand,
            'model' => $car->model,
            'year' => $car->year,
            'price' => (float) $car->price,
            'price_type' => $car->price_type,
            'title' => $car->title,
            'title_am' => $car->title_am,
            'sale_rent' => $car->sale_rent,
            'seller_type' => $car->seller_type,
            'transmission' => $car->transmission,
            'fuel' => $car->fuel,
            'body_type' => $car->body_type,
            'color' => $car->color,
            'mileage' => $car->mileage,
            'engine_size' => $car->engine_size,
            'drive_type' => $car->drive_type,
            'condition' => $car->condition,
            'seats' => $car->seats,
            'doors' => $car->doors,
            'contact_phone' => $car->contact_phone,
            'contact_email' => $car->contact_email,
            'description' => $car->description,
            'first_image' => $imageUrls[0] ?? 'https://placehold.co/600x360?text=Car',
            'images' => $imageUrls,
            'created_at' => optional($car->created_at)->toISOString(),
        ];
    });

    return view('user.cars.index', compact('cars', 'carsForJS'));
}

public function edit($id)
{
    $car = Car::findOrFail($id);
    $user = auth()->user(); // current logged-in user
    return view('owner.cars.edit', compact('car', 'user'));
}

    /**
     * Store a newly created car.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'title_am' => 'nullable|string|max:255',
        'description_am' => 'nullable|string',
        'year' => 'required|numeric|min:1900|max:' . date('Y'),
        'transmission' => 'required|string',
        'body_type' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:255',
        'fuel' => 'nullable|string|max:255',
        'engine_size' => 'nullable|string|max:255',
        'mileage' => 'nullable|numeric|min:0',
        'price' => 'required|numeric|min:0',

        // Seller info
'name' => 'required|string',
'phone' => 'required|string',
'seller_type' => 'required|string',
'email' => 'nullable|email',
'address' => 'nullable|string',


        'sale_rent' => 'required|in:sale,rent',
        'price_type' => 'required|in:fixed,negotiable,slightly_negotiable',
        'is_featured' => 'nullable|boolean',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:10240',
        'description' => 'nullable|string',
        'seats' => 'nullable|integer|min:1|max:20',
        'doors' => 'nullable|integer|min:1|max:10',
        'drive_type' => 'nullable|string|max:50',
        'condition' => 'nullable|string|max:50',
    ]);

    $car = new Car();
    $car->brand = $validated['brand'];
    $car->model = $validated['model'];
    $car->year = $validated['year'];
    $car->transmission = $validated['transmission'];
    $car->body_type = $validated['body_type'] ?? null;
    $car->color = $validated['color'] ?? null;
    $car->fuel = $validated['fuel'] ?? null;
    $car->engine_size = $validated['engine_size'] ?? null;
    $car->mileage = $validated['mileage'] ?? null;
    $car->price = $validated['price'];

    // Seller info saved directly in the cars table
$car->seller_name   = $validated['name'];
$car->seller_type   = $validated['seller_type'];
$car->contact_phone = $validated['phone'];
$car->contact_email = $validated['email'] ?? null;
$car->seller_address = $validated['address'] ?? null;

    $car->sale_rent = $validated['sale_rent'];
    $car->price_type = $validated['price_type'];
    $car->is_featured = $request->has('is_featured');
    $car->user_id = auth()->id(); // Owner of the post
    $car->description = $validated['description'] ?? null;
    $car->seats = $validated['seats'] ?? null;
    $car->doors = $validated['doors'] ?? null;
    $car->drive_type = $validated['drive_type'] ?? null;
    $car->condition = $validated['condition'] ?? null;
    $car->title = $validated['title'];
    $car->title_am = $validated['title_am'] ?? null;
    $car->description_am = $validated['description_am'] ?? null;

    // Store multiple images
    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $images[] = $image->store('cars/images', 'public');
        }
    }
    $car->images = $images;

    // Store video
    if ($request->hasFile('video')) {
        $car->video = $request->file('video')->store('cars/videos', 'public');
    }
    $car->status = 'pending';


    $car->save();

   return redirect()->back()->with(
    'success',
    'Car posted successfully. It will be visible once approved by the admin.'
);

}


public function update(Request $request, $id)
{
    $car = Car::findOrFail($id);

    // Validate required fields
    $validated = $request->validate([
        'brand' => 'required|string',
        'model' => 'required|string',
        'title' => 'required|string',
        'year' => 'required|numeric|min:1900|max:' . date('Y'),
        'transmission' => 'required|string',
        'price' => 'required|numeric',
        'price_type' => 'required|string',
        'sale_rent' => 'required|string|in:sale,rent',

        // seller info fields
 'seller_name' => 'required|string',
    'contact_phone' => 'required|string',
    'seller_type' => 'required|string',
    'contact_email' => 'nullable|email',
    'seller_address' => 'nullable|string',
    ]);

    // Convert features to JSON
    $validated['features'] = $request->features ? json_encode($request->features) : json_encode([]);

    // Update main car fields
    $car->update($validated);

    // Save seller info (NEW)
    $car->seller_name = $request->name;
    $car->seller_type = $request->seller_type;
    $car->contact_phone = $request->phone;
    $car->contact_email = $request->email;
    $car->seller_address = $request->address;
    $car->save();

    // Update images if uploaded
    if ($request->hasFile('images')) {
        $paths = [];
        foreach ($request->file('images') as $img) {
            $paths[] = $img->store('cars', 'public');
        }
        $car->images = $paths;
        $car->save();
    }

    // Update video if uploaded
    if ($request->hasFile('video')) {
        $car->video = $request->file('video')->store('cars/videos', 'public');
        $car->save();
    }

    // Redirect to total posts with success message
    return redirect()->route('owner.totalPosts')
        ->with('success', 'Car updated successfully!');
}



    /**
     * Show single car details.
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);
        
        // Decode and normalize images to URLs (copying house logic)
        $rawImages = [];
        if (!empty($car->images) && is_array($car->images)) {
            $rawImages = $car->images;
        } elseif (!empty($car->images) && !is_array($car->images)) {
            $decoded = json_decode($car->images, true);
            $rawImages = is_array($decoded) ? $decoded : [];
        }
    
        $imageUrls = [];
        foreach ($rawImages as $p) {
            if (empty($p)) continue;
            $path = ltrim($p, '/');
    
            if (preg_match('/^https?:\/\//i', $path)) {
                $imageUrls[] = $path;
            } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $imageUrls[] = asset('storage/' . $path);
            } elseif (file_exists(public_path($path))) {
                $imageUrls[] = asset($path);
            } elseif (file_exists(public_path('uploads/' . $path))) {
                $imageUrls[] = asset('uploads/' . $path);
            }
        }
    
        // Pick first image for fallback
        $firstImage = $imageUrls[0] ?? null;
    
        return view('user.cars.show', compact('car', 'imageUrls', 'firstImage'));
    }

    /**
     * Soft delete a car (does not remove from DB).
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete(); // soft delete
        return redirect()->back()->with('success', '🚗 Car moved to trash (soft deleted).');
    }

    /**
     * Restore a soft-deleted car.
     */
    public function restore($id)
    {
        $car = Car::onlyTrashed()->findOrFail($id);
        $car->restore();

        return redirect()->back()->with('success', '✅ Car restored successfully!');
    }

    /**
     * Permanently delete a soft-deleted car.
     */
    public function forceDelete($id)
    {
        $car = Car::onlyTrashed()->findOrFail($id);
        $car->forceDelete();

        return redirect()->back()->with('success', '❌ Car permanently deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Models\House;
use App\Models\CallbackRequest;
use App\Rules\PhoneNumberRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
public function index(Request $request)
{
    $query = House::query();

    // Basic filters (expandable)
    if ($request->filled('q')) {
        $q = $request->q;
        $query->where(function($q2) use ($q) {
            $q2->where('title_en', 'like', "%{$q}%")
               ->orWhere('title_am','like', "%{$q}%")
               ->orWhere('description_en','like', "%{$q}%")
               ->orWhere('description_am','like', "%{$q}%");
        });
    }

    if ($request->filled('purpose')) {
        $query->where('purpose', $request->purpose);
    }

    if ($request->filled('region')) {
        $query->where('region', $request->region);
    }

    if ($request->filled('min_price')) {
        $query->whereRaw("CAST(REPLACE(price, ',', '') AS UNSIGNED) >= ?", [$request->min_price]);
    }
    if ($request->filled('max_price')) {
        $query->whereRaw("CAST(REPLACE(price, ',', '') AS UNSIGNED) <= ?", [$request->max_price]);
    }

    // Amenity filter example
    if ($request->filled('amenities')) {
        foreach ((array)$request->amenities as $amen) {
            $query->whereJsonContains('amenities', $amen);
        }
    }

    // Paginate for Blade
    // Only approved on public index
    $query->where('status', 'approved');
    $houses = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

    // Prepare houses for AlpineJS (JS-friendly array)
    $housesForJS = $houses->map(function($house){
        // Normalize images to an array of URLs (supports storage and public paths)
        // House::$casts already decodes 'images' to an array (or null)
        $rawImages = $house->images ?? [];

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
            if (Storage::disk('public')->exists($path)) {
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
            'id' => $house->id,
            'title' => $house->title_en ?? $house->title_am,
            // Provide canonical keys used by the frontend filters
            'region' => $house->region ?? '',
            // Prefer language-specific subcity/city fields as present in seed/data
            'location' => $house->subcity_en
                ?? $house->subcity_am
                ?? $house->subcity
                ?? $house->city_en
                ?? $house->city_am
                ?? $house->city
                ?? '',
            // Keep legacy keys just in case any template references them
            'city' => $house->city_en ?? $house->city_am ?? $house->city ?? '',
            'subcity' => $house->subcity_en ?? $house->subcity_am ?? $house->subcity ?? '',
            'price' => (float) str_replace(',', '', $house->price),
            'bedrooms' => $house->bedrooms,
            'bathrooms' => $house->bathrooms,
            'area_m2' => $house->area_m2,
            'property_type' => $house->property_type,
            'purpose' => $house->purpose,
            'verified' => (bool)$house->verified,
            'amenities' => is_array($house->amenities) ? $house->amenities : (json_decode($house->amenities, true) ?: []),
            'first_image' => $imageUrls[0] ?? 'https://placehold.co/600x360?text=House',
            'images' => $imageUrls,
            'contact_phone' => $house->contact_phone,
            'built_year' => $house->built_year,
            'created_at' => optional($house->created_at)->toISOString(),
            'seller_type' => $house->seller_type ?? '', // <-- ADD THIS
        ];
    });

    return view('user.houses.index', compact('houses', 'housesForJS'));
}

// Show the edit form for a specific house
public function edit(House $house)
{
    // Optional: check if the authenticated owner owns this house
    if ($house->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    return view('owner.house.edit', compact('house'));
}

// Update the house after editing
public function update(UpdateHouseRequest $request, House $house)
{
    if ($house->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    $data = $request->validated();

    // Moderation status/slug must never be settable by the owner via this endpoint
    unset($data['status'], $data['slug']);

    // Handle amenities (already cast as array)
    $data['amenities'] = $request->input('amenities', []);

    // Handle images
    $images = $request->input('existing_images', []); // Keep existing images
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $path = $img->store('houses', 'public');
            $images[] = $path;
        }
    }
    $data['images'] = $images;

    // Cast checkboxes properly
    $data['negotiable'] = $request->has('negotiable');
    $data['installment'] = $request->has('installment');
    $data['garage'] = $request->has('garage');

    // Make sure price is numeric
    $data['price'] = str_replace(',', '', $data['price']);

    $house->update($data);

    return redirect()->route('owner.totalPosts')
                     ->with('success', '✅ House updated successfully.');
}


public function destroy(House $house)
{
    if ($house->user_id !== auth()->id()) {
        abort(403, 'Unauthorized');
    }

    // Soft delete only — files stay on disk until the recycle bin permanently
    // deletes the house, otherwise a later restore would show broken images.
    $house->delete();

    return redirect()->route('owner.totalPosts')
                     ->with('success', 'House deleted successfully!');
}

public function create()
{
    return view('owner.house.create');
}

    public function store(StoreHouseRequest $request)
    {
        $data = $request->validated();

        // Handle images if uploaded
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('houses', 'public');
                $images[] = $path;
            }
        }

        // Prepare data for storage
        $data['images'] = $images;
        $data['amenities'] = $request->input('amenities', []);
        $data['negotiable'] = (bool) $request->input('negotiable', false);
        $data['installment'] = (bool) $request->input('installment', false);
        $data['garage'] = (bool) $request->input('garage', false);
        $data['verified'] = false; // Default to unverified
        $data['status'] = 'pending'; // Default to pending approval

        // Strip formatting (e.g. "1,500,000") so the float cast doesn't truncate at the first comma
        $data['price'] = str_replace(',', '', $data['price']);

        // Set current user as owner
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        // Create slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['title_en']) . '-' . \Illuminate\Support\Str::random(6);
        }

        $house = House::create($data);

        return redirect()->route('owner.totalPosts')
            ->with('success', '✅ House posted successfully! It will be reviewed by admin and published shortly.');
    }
    
    public function show($id)
    {
        $house = House::findOrFail($id);

        $isOwner = auth()->check() && auth()->id() === $house->user_id;
        $isAdmin = auth()->check() && auth()->user()->hasRole('admin');

        if ($house->status !== 'approved' && !$isOwner && !$isAdmin) {
            abort(404);
        }

        // Decode and normalize images to URLs
        // House::$casts already decodes 'images' to an array (or null)
        $rawImages = $house->images ?? [];
    
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
    
        return view('user.houses.show', compact('house', 'imageUrls', 'firstImage'));
    }
    

    // add edit/update/destroy as needed

   public function contact(Request $request, House $house)
{
    $request->validate([
        'name' => 'required|string',
        'phone' => ['required', 'string', new PhoneNumberRule],
        'message' => 'nullable|string',
    ]);

    CallbackRequest::create([
        'house_id' => $house->id,
        'name' => $request->name,
        'phone' => $request->phone,
        'message' => $request->message,
    ]);

    return back()->with('success','Call back request sent successfully.');
}

public function ownerIndex()
{
    $houses = House::where('user_id', auth()->id())
                    ->orderByDesc('created_at')
                    ->get();

    return view('owner.house.index', compact('houses'));
}

}

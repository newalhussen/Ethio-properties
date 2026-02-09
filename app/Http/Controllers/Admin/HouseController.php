<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;

class HouseController extends Controller
{
    // All houses (admin listing)
    public function index()
    {
        $houses = House::with('owner')->latest()->paginate(15);
        return view('admin.houses.index', compact('houses'));
    }

    // Pending approval
    public function pending()
    {
        $houses = House::with('owner')->where('status', 'pending')->latest()->paginate(15);
        return view('admin.houses.pending', compact('houses'));
    }

    // Approved houses
    public function approved()
    {
        $houses = House::with('owner')->where('status', 'approved')->latest()->paginate(15);
        return view('admin.houses.approved', compact('houses'));
    }

    // Rejected houses
    public function rejected()
    {
        $houses = House::with('owner')->where('status', 'rejected')->latest()->paginate(15);
        return view('admin.houses.rejected', compact('houses'));
    }

    // Show a single house details
    public function show($id)
    {
        $house = House::with('owner')->findOrFail($id);

        // Normalize images (accept array, json-string, csv)
        $images = [];
        if (!empty($house->images)) {
            if (is_array($house->images)) {
                $images = $house->images;
            } elseif (is_string($house->images)) {
                $decoded = json_decode($house->images, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $images = $decoded;
                } else {
                    $images = array_filter(array_map('trim', explode(',', $house->images)));
                }
            }
        }

        // Convert to public URLs
        $imageUrls = [];
        foreach ($images as $p) {
            if (empty($p)) continue;
            $path = ltrim($p, '/');
            if (preg_match('/^https?:\/\//i', $path)) {
                $imageUrls[] = $path;
                continue;
            }
            if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) {
                $imageUrls[] = asset('storage/' . $path);
                continue;
            }
            if (file_exists(public_path($path))) {
                $imageUrls[] = asset($path);
                continue;
            }
            if (file_exists(public_path('uploads/' . $path))) {
                $imageUrls[] = asset('uploads/' . $path);
                continue;
            }
        }

        return view('admin.houses.show', compact('house', 'imageUrls'));
    }

    // Delete house
    public function destroy($id)
    {
        $house = House::findOrFail($id);
        $house->delete();
        return redirect()->route('admin.houses.index')->with('success', 'House deleted successfully.');
    }

    // Approve (AJAX)
    public function approve($id)
    {
        $house = House::findOrFail($id);
        $house->status = 'approved';
        $house->approved_at = now();
        $house->approved_by = auth()->id();
        $house->rejection_reason = null;
        $house->save();

        return response()->json(['message' => 'House approved successfully'], 200);
    }

    // Reject (AJAX)
    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $house = House::findOrFail($id);
        $house->status = 'rejected';
        $house->rejection_reason = $request->rejection_reason;
        $house->approved_at = null;
        $house->approved_by = null;
        $house->save();

        return response()->json(['message' => 'House rejected successfully'], 200);
    }
    
    public function toggleFeatured(\App\Models\House $house)
{
    $house->is_featured = ! $house->is_featured;
    $house->save();

    return response()->json([
        'message' => $house->is_featured
            ? 'House marked as featured'
            : 'House unmarked as featured'
    ]);
}

}

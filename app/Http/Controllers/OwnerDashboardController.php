<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\View;
use App\Models\Notification;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OwnerDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'owner']);
    }

    /**
     * Display the owner's dashboard
     */
    public function index()
{
    $user = Auth::user();

    // Fetch all cars belonging to this user
    $cars = $user->cars()->latest()->paginate(10);

    // Dashboard metrics
    $totalPosts = $cars->total();
    $activePosts = $cars->where('status', 'active')->count();
    $soldPosts = $cars->where('status', 'sold')->count();

    // Calculate total views
    $viewsCount = View::whereIn('car_id', $cars->pluck('id'))->count();
    $phoneViews = View::whereIn('car_id', $cars->pluck('id'))
        ->where('type', 'phone')
        ->count();

    // Latest notifications
    $notifications = Notification::where('user_id', $user->id)
        ->latest()
        ->limit(10)
        ->get();

    return view('owner.dashboard', compact(
        'cars',
        'totalPosts',
        'activePosts',
        'soldPosts',
        'viewsCount',
        'phoneViews',
        'notifications'
    ));
}

    /**
     * Show form to create a new car listing
     */
    public function create()
    {
        return view('owner.cars.create');
    }

    /**
     * Store a new car listing
     */

public function store(Request $request)
{
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|numeric|min:1900|max:' . date('Y'),
        'transmission' => 'required|string',
        'body_type' => 'nullable|string|max:255',
        'color' => 'nullable|string|max:255',
        'fuel' => 'nullable|string|max:255',
        'engine_size' => 'nullable|string|max:255',
        'mileage' => 'nullable|numeric',
        'price' => 'required|numeric|min:0',
        'price_type' => 'required|in:fixed,negotiable,slightly_negotiable',
        'sale_rent' => 'required|in:sale,rent',
        'seller_type' => 'required|string',
        'phone' => ['required', 'string', 'max:255', new PhoneNumberRule],
        'email' => 'nullable|email|max:255',
        'description' => 'nullable|string',
        'seats' => 'nullable|integer|min:1|max:20',
        'doors' => 'nullable|integer|min:1|max:10',
        'drive_type' => 'nullable|string|max:50',
        'condition' => 'nullable|string|max:50',
        'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
    ]);

    $user = Auth::user();

    DB::beginTransaction();

    try {
        // Prepare car data
        $carData = collect($validated)->only([
            'brand','model','year','transmission','body_type','color',
            'fuel','engine_size','mileage','price','price_type','sale_rent',
            'seller_type','phone','email','description','seats','doors',
            'drive_type','condition'
        ])->toArray();

        // Set default status to pending for admin approval
        $carData['status'] = 'pending';
        $carData['user_id'] = $user->id;

        // Create car directly for the user
        $car = Car::create($carData);

        // Handle images 
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars/images', 'public');
                $images[] = $path;
            }
        }
        $car->images = $images;

        // Handle video
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('cars/videos', 'public');
            $car->video = $videoPath;
        }

        $car->save();

        DB::commit();

        return redirect()->route('owner.totalPosts')
            ->with('success', '✅ Car posted successfully! It will be reviewed by admin and published shortly.');
    } catch (\Throwable $e) {
        DB::rollBack();
        Log::error('OwnerDashboardController@store error: '.$e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);

        return redirect()->back()
            ->withInput()
            ->with('error', 'Failed to create car listing. Please try again.');
    }
}
    /**
     * Show edit form for a specific car
     */
    public function edit(Car $car)
    {
        $this->checkOwnership($car);
        return view('owner.cars.edit', compact('car'));
    }

    /**
     * Update a car listing
     */
    public function update(Request $request, Car $car)
    {
        $this->checkOwnership($car);

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'transmission' => 'required|string',
            'body_type' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'fuel' => 'nullable|string|max:255',
            'engine_size' => 'nullable|string|max:255',
            'mileage' => 'nullable|numeric',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,negotiable,slightly_negotiable',
            'sale_rent' => 'required|in:sale,rent',
        ]);

        $car->update($validated);

        return redirect()
            ->route('owner.dashboard')
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Delete a car listing
     */
public function destroy($id)
{
    $car = Car::withTrashed()->findOrFail($id); // include soft-deleted if needed
    $this->checkOwnership($car);
    $car->delete();

    return redirect()->route('owner.cars.index')->with('success', 'Car deleted successfully.');
}


    /**
     * Mark a car as sold
     */
    public function markSold(Car $car)
    {
        $this->checkOwnership($car);
        $car->status = 'sold';
        $car->save();

        return redirect()
            ->back()
            ->with('success', 'Car marked as sold.');
    }

    /**
     * Record that a visitor revealed/viewed this car's phone number.
     */
    public function phoneView(Car $car)
    {
        View::create([
            'car_id' => $car->id,
            'user_id' => Auth::id(),
            'type' => 'phone',
            'ip_address' => request()->ip(),
        ]);

        return response()->json(['success' => true]);
    }

    /**
     * Helper function to ensure car belongs to logged-in user
     */
    private function checkOwnership(Car $car)
    {
        $user = Auth::user();

        if ($car->user_id !== $user->id) {
            abort(403, 'Unauthorized action.');
        }
    }

public function totalPosts()
{
    $user = auth()->user();

    

    // Active/approved cars
    $cars = $user->cars()->latest()->get();

    // Soft-deleted cars
    $trashedCars = collect();
    if (method_exists($user->cars(), 'onlyTrashed')) {
        $trashedCars = $user->cars()->onlyTrashed()->get();
    }

    // Active/approved houses
    $houses = collect();
    $trashedHouses = collect();
    
    if (method_exists($user, 'houses')) {
        $houses = $user->houses()->latest()->get();
        if (method_exists($user->houses(), 'onlyTrashed')) {
            $trashedHouses = $user->houses()->onlyTrashed()->get();
        }
    }

    return view('owner.total_posts', compact('cars', 'trashedCars', 'houses', 'trashedHouses'));
}

public function carsIndex()
{
    $user = auth()->user();

$cars = Car::where('user_id', $user->id)
    ->latest()
    ->get();

    return view('owner.cars.index', compact('cars'));
}
}
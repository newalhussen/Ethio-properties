<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\House;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display the admin dashboard
     */
    public function dashboard()
    {
        // Get counts for dashboard widgets
        $counts = [
            'Car' => Car::count(),
            'House' => House::count(),
            'User' => User::count(),
            'Contact' => Contact::count(),
            'Pending' => Car::where('status', 'pending')->count() + House::where('status', 'pending')->count(),
            'ApprovedCars' => Car::where('status', 'approved')->count(),
            'ApprovedHouses' => House::where('status', 'approved')->count(),
            'Rejected' => Car::where('status', 'rejected')->count() + House::where('status', 'rejected')->count(),
        ];

        // Get recent pending posts for review
        $pendingCars = Car::where('status', 'pending')->latest()->limit(5)->get();
        $pendingHouses = House::where('status', 'pending')->latest()->limit(5)->get();

        // Get recent users
        $recentUsers = User::latest()->limit(5)->get();

        // Get recent messages
        $recentMessages = Contact::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'counts',
            'pendingCars',
            'pendingHouses',
            'recentUsers',
            'recentMessages'
        ));
    }

    /**
     * Display admin profile
     */
    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile', compact('admin'));
    }

    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle admin login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // Check if user exists and has admin role
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        if ($user->role !== 'admin') {
            return back()->withErrors(['email' => 'Access denied. Admin privileges required.'])->withInput();
        }

        // Login the user
        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }

    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login'); // or redirect()->route('login')
}

}

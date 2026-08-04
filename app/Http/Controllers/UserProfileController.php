<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('owner.profile.edit', compact('user'));
    }

public function update(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'email' => 'required|email',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
    ]);

    // Handle avatar upload
    if ($request->hasFile('avatar')) {
        // Delete old avatar if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Store new avatar in 'avatars' folder
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
    }

    // Update other fields
    $user->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'email' => $request->email,
    ]);

    return back()->with('success', 'Profile updated successfully.');
}

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
{
    $googleUser = Socialite::driver('google')->user();

    // Try to find user by google_id
    $user = User::where('google_id', $googleUser->getId())->first();

    // If not found, try by email
    if (!$user) {
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            // Attach google_id to existing account
            $user->update([
                'google_id' => $googleUser->getId(),
            ]);
        } else {
            // Create new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(24)),
                'avatar' => $googleUser->getAvatar(),
            ]);
        }
    }

    // ✅ ENSURE owner role
    if (!$user->hasAnyRole(['owner', 'admin'])) {
        $user->assignRole('owner');
    }

    Auth::login($user, true);

    return redirect()->intended('/');
}

}

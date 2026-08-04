<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerSettingsRequest;
use App\Models\OwnerSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class OwnerSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show settings page
    public function edit()
    {
        $user = auth()->user();
        $settings = OwnerSetting::firstOrCreate(['user_id' => $user->id], [
            'default_listing_type' => 'rent',
            'list_view' => 'grid',
            'currency_format' => '1,000',
            'measurement_unit' => 'sqm',
        ]);

        return view('owner.settings', compact('user', 'settings'));
    }

    // Update profile + settings (single endpoint will handle different forms by input 'section')
    public function update(OwnerSettingsRequest $request)
    {
        $user = auth()->user();
        $settings = OwnerSetting::firstOrCreate(['user_id' => $user->id]);

        $section = $request->input('section', 'profile');

        if ($section === 'profile') {
            // Avatar handling
            if ($request->hasFile('avatar')) {
                // store in storage/app/public/avatars
                $path = $request->file('avatar')->store('avatars', 'public');

                // delete old avatar if exists
                if ($user->avatar && \Storage::disk('public')->exists($user->avatar)) {
                    \Storage::disk('public')->delete($user->avatar);
                }
                $user->avatar = $path;
            }

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->save();

            return back()->with('success', 'Profile updated successfully.');
        }

        if ($section === 'notifications') {
            $settings->update([
                'notify_email_inquiries' => $request->boolean('notify_email_inquiries'),
                'notify_sms_inquiries' => $request->boolean('notify_sms_inquiries'),
                'notify_property_views' => $request->boolean('notify_property_views'),
                'notify_property_favorites' => $request->boolean('notify_property_favorites'),
                'notify_weekly_digest' => $request->boolean('notify_weekly_digest'),
            ]);

            return back()->with('success', 'Notification settings updated.');
        }

        if ($section === 'preferences') {
            $settings->update([
                'default_listing_type' => $request->input('default_listing_type'),
                'list_view' => $request->input('list_view'),
                'currency_format' => $request->input('currency_format'),
                'measurement_unit' => $request->input('measurement_unit'),
                'dark_mode' => $request->boolean('dark_mode'),
            ]);

            return back()->with('success', 'Preferences updated.');
        }

        if ($section === 'password') {
            $current = $request->input('current_password');
            $password = $request->input('password');

            if (! $current || ! Hash::check($current, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user->password = Hash::make($password);
            $user->save();

            return back()->with('success', 'Password updated.');
        }

        if ($section === 'delete_account') {
            $current = $request->input('current_password');

            if (! $current || ! Hash::check($current, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }

            $user->delete();
            auth()->logout();
            return redirect('/')->with('success', 'Account deleted.');
        }

        return back();
    }
}

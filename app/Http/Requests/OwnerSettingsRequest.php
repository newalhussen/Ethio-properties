<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OwnerSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        $userId = auth()->id();

        return [
            // Profile
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users')->ignore($userId)],
            'phone' => ['nullable','string','max:30'],
            'avatar' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],

            // Notifications
            'notify_email_inquiries' => ['sometimes','boolean'],
            'notify_sms_inquiries' => ['sometimes','boolean'],
            'notify_property_views' => ['sometimes','boolean'],
            'notify_property_favorites' => ['sometimes','boolean'],
            'notify_weekly_digest' => ['sometimes','boolean'],

            // Preferences
            'default_listing_type' => ['required','in:rent,sale'],
            'list_view' => ['required','in:grid,list'],
            'currency_format' => ['required','string','max:10'],
            'measurement_unit' => ['required','in:sqm,sqft'],
            'dark_mode' => ['sometimes','boolean'],

            // Password fields (optional)
            'current_password' => ['nullable','string'],
            'password' => ['nullable','string','min:8','confirmed'],
        ];
    }
}

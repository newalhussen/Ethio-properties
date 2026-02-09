<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHouseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // adjust to auth logic if needed
    }

    public function rules()
    {
        return [
            'title_en' => 'required|string|max:255',
            'title_am' => 'nullable|string|max:255',
            'description_en' => 'required|string|max:2000',
            'description_am' => 'nullable|string|max:2000',
            'purpose' => 'required|in:for_sale,for_rent',
            'price' => 'required|string|max:255',
            'negotiable' => 'sometimes|boolean',
            'installment' => 'sometimes|boolean',
            'region' => 'required|string|max:100',
            'subcity_en' => 'nullable|string|max:100',
            'subcity_am' => 'nullable|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'bedrooms' => 'required|integer|min:0|max:50',
            'bathrooms' => 'required|integer|min:0|max:50',
            'area_m2' => 'required|integer|min:1|max:10000',
            'parking' => 'nullable|integer|min:0|max:20',
            'property_type' => 'required|string|max:100',
            'built_year' => 'nullable|integer|min:1800|max:'.(date('Y')+1),
            'floors' => 'nullable|integer|min:0|max:100',
            'garage' => 'sometimes|boolean',
            'amenities' => 'nullable|array',
            'amenities.*' => 'string|max:100',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120', // up to 5MB each
            'images' => 'required|array|min:1|max:10',
            'seller_type' => 'required|string|max:100',
            'contact_phone' => 'required|string|max:30',
            'contact_email' => 'nullable|email|max:255',
            'verified' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => 'House title is required.',
            'description_en.required' => 'House description is required.',
            'purpose.required' => 'Please select if the house is for sale or rent.',
            'price.required' => 'House price is required.',
            'region.required' => 'Please select a region.',
            'city_en.required' => 'City is required.',
            'subcity_en.required' => 'Subcity is required.',
            'address.required' => 'Address is required.',
            'latitude.required' => 'Please select location on map.',
            'longitude.required' => 'Please select location on map.',
            'bedrooms.required' => 'Number of bedrooms is required.',
            'bathrooms.required' => 'Number of bathrooms is required.',
            'area_m2.required' => 'Area in square meters is required.',
            'property_type.required' => 'Property type is required.',
            'images.required' => 'At least one image is required.',
            'images.min' => 'At least one image is required.',
            'images.max' => 'Maximum 10 images allowed.',
            'seller_type.required' => 'Seller type is required.',
            'contact_phone.required' => 'Contact phone number is required.',
            'contact_email.email' => 'Please enter a valid email address.',
            'area_m2.min' => 'Area must be at least 1 square meter.',
            'area_m2.max' => 'Area cannot exceed 10,000 square meters.',
            'built_year.max' => 'Built year cannot be in the future.',
        ];
    }
}

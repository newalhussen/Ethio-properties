<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHouseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
return [
    'title_en'        => 'required|string|max:255',
    'title_am'        => 'nullable|string|max:255',

    'description_en'  => 'required|string',
    'description_am'  => 'nullable|string',

    'price'           => 'required|numeric|min:0',

    'property_type'   => 'required|string|max:100',
    'purpose'         => 'required|string|max:50',

    'region'          => 'required|string|max:100',

    'city_en'         => 'nullable|string|max:100',
    'city_am'         => 'nullable|string|max:100',
    'subcity_en'      => 'nullable|string|max:100',
    'subcity_am'      => 'nullable|string|max:100',

    'built_year'      => 'nullable|integer|min:1900|max:' . date('Y'),
    'area_m2'         => 'nullable|numeric|min:0',
    'bedrooms'        => 'nullable|integer|min:0',
    'bathrooms'       => 'nullable|integer|min:0',

    // Amenities array
    'amenities'       => 'nullable|array',
    'amenities.*'     => 'string|max:100',

    // Existing image list from edit page
    'existing_images' => 'nullable|array',
    'existing_images.*' => 'string',

    // New uploads
    'images'          => 'nullable|array',
    'images.*'        => 'image|mimes:jpg,jpeg,png,webp|max:4096',

    // Boolean checkboxes
    'negotiable'      => 'sometimes|boolean',
    'installment'     => 'sometimes|boolean',
    'garage'          => 'sometimes|boolean',

    'seller_type'     => 'required|in:owner,broker,dealer,agent',

    // Optional (auto-generated or system-handled)
    'slug'            => 'nullable|string',
    'status'          => 'nullable|string',
];


    }
}

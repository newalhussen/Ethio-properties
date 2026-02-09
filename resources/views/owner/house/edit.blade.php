@extends('layouts.owner')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-10">
    <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden">

    <!-- Step Indicators with numbers -->
<div class="flex justify-center mt-4 mb-6 space-x-2">
    <div id="step1Indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-purple-600 text-white font-bold">1</div>
    <div id="step2Indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">2</div>
    <div id="step3Indicator" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-300 text-gray-700 font-bold">3</div>
</div>
    
    <!-- Form -->
        <form id="houseForm" action="{{ route('owner.houses.update', $house->id) }}" method="POST" enctype="multipart/form-data" class="transition-colors">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- STEP 1: Basic Information -->
            <div id="step1" class="form-step p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Basic Information</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <!-- Title EN -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Title *</label>
                        <input type="text" name="title_en" value="{{ old('title_en', $house->title_en) }}"
                               class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                               placeholder="e.g., Beautiful 3-bedroom villa in Bole" required>
                    </div>

                    <!-- Title AM -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Title (Amharic)</label>
                        <input type="text" name="title_am" value="{{ old('title_am', $house->title_am) }}"
                               class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                               placeholder="አመልካች 3 የአልጋ ቤት በቦሌ">
                    </div>

                    <!-- Purpose -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Purpose *</label>
                        <select name="purpose" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            <option value="">Select Purpose</option>
                            <option value="for_sale" {{ old('purpose', $house->purpose) == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="for_rent" {{ old('purpose', $house->purpose) == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                        </select>
                    </div>

                    <!-- Property Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Type *</label>
                        <select name="property_type" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            <option value="">Select Property Type</option>
                            @foreach(['Villa','Apartment','Condominium','Commercial','Guest House','Land / Plot'] as $type)
                                <option value="{{ $type }}" {{ old('property_type', $house->property_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Price (ETB) *</label>
                        <input type="text" name="price" value="{{ old('price', $house->price) }}"
                               class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                               placeholder="e.g., 2,500,000" required>
                    </div>

                    <!-- Built Year -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Built Year</label>
                        <select name="built_year" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                            <option value="">Select Year</option>
                            @for ($year = date('Y'); $year >= 1950; $year--)
                                <option value="{{ $year }}" {{ old('built_year', $house->built_year) == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Bedrooms -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Bedrooms *</label>
                        <select name="bedrooms" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            @for ($i=0;$i<=10;$i++)
                                <option value="{{ $i }}" {{ old('bedrooms', $house->bedrooms) == $i ? 'selected' : '' }}>{{ $i == 0 ? 'Studio' : $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Bathrooms *</label>
                        <select name="bathrooms" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            @for ($i=1;$i<=10;$i++)
                                <option value="{{ $i }}" {{ old('bathrooms', $house->bathrooms) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Area -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Area (m²) *</label>
                        <input type="number" name="area_m2" value="{{ old('area_m2', $house->area_m2) }}"
                               class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                               min="1" max="10000" required>
                    </div>

                    <!-- Floors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Number of Floors</label>
                        <select name="floors" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                            <option value="">Select Floors</option>
                            @for ($i=1;$i<=10;$i++)
                                <option value="{{ $i }}" {{ old('floors', $house->floors) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Parking -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Parking Spaces</label>
                        <select name="parking" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                            <option value="">Select Parking</option>
                            @for ($i=0;$i<=10;$i++)
                                <option value="{{ $i }}" {{ old('parking', $house->parking) == $i ? 'selected' : '' }}>{{ $i == 0 ? 'No Parking' : $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Checkboxes -->
                    <div class="lg:col-span-2 flex flex-wrap gap-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="negotiable" value="1" {{ old('negotiable', $house->negotiable) ? 'checked' : '' }}
                                   class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Price Negotiable</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="installment" value="1" {{ old('installment', $house->installment) ? 'checked' : '' }}
                                   class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Installment Available</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="garage" value="1" {{ old('garage', $house->garage) ? 'checked' : '' }}
                                   class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">Garage</span>
                        </label>
                    </div>

                    <!-- Description EN -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description *</label>
                        <textarea name="description_en" rows="4" required
                                  class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                                  placeholder="Describe your property in detail...">{{ old('description_en', $house->description_en) }}</textarea>
                    </div>

                    <!-- Description AM -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description (Amharic)</label>
                        <textarea name="description_am" rows="4"
                                  class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100"
                                  placeholder="በዝርዝር የንብረትዎን ይግለጹ...">{{ old('description_am', $house->description_am) }}</textarea>
                    </div>

                </div>

                <div class="flex justify-end mt-8">
                    <button type="button" class="next-btn bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-medium">Next</button>
                </div>
            </div>

            <!-- STEP 2: Location & Details -->
            <div id="step2" class="form-step hidden p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Location & Details</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Region -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Region *</label>
                        <select name="region" id="region" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            <option value="">Select Region</option>
                            @foreach(['Addis Ababa','Adama','Bahir Dar','Bishoftu','Dire Dawa','Gondar','Hawassa','Mekelle','Jimma','Harar'] as $region)
                                <option value="{{ $region }}" {{ old('region', $house->region) == $region ? 'selected' : '' }}>{{ $region }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subcity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Subcity *</label>
                        <select name="subcity_en" id="subcity" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            <option value="{{ old('subcity_en', $house->subcity_en) }}">{{ old('subcity_en', $house->subcity_en) }}</option>
                        </select>
                    </div>

                    <!-- Address -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Full Address *</label>
                        <input type="text" name="address" value="{{ old('address', $house->address) }}" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                    </div>

                    <!-- Hidden latitude/longitude -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $house->latitude) }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $house->longitude) }}">

                    <!-- Map container -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Location on Map (Optional)</label>
                        <div id="map" class="w-full h-96 border rounded-lg dark:border-gray-700 dark:bg-gray-900"></div>
                        <button type="button" id="geocodeAddress" class="mt-2 text-sm text-purple-600 hover:text-purple-800 font-medium">📍 Find Address</button>
                    </div>

                    <!-- Amenities -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Amenities</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @php
                                $amenities = ['Parking','Balcony','Security','Elevator','Water Tank','Generator','Internet','Furnished','Garden','Swimming Pool','Garage','Air Conditioning','Laundry Room','Terrace','Storage','Pet Friendly','Near School','Near Hospital','Near Shopping','Public Transport','Gym','Playground','24/7 Security','Backup Power'];
                            @endphp
                            @foreach ($amenities as $amenity)
                                <label class="flex items-center">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity }}" {{ in_array($amenity, old('amenities', $house->amenities ?? [])) ? 'checked' : '' }} class="w-4 h-4 text-purple-600 rounded focus:ring-purple-500 dark:bg-gray-900 dark:border-gray-700">
                                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-200">{{ $amenity }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" class="prev-btn text-purple-600 hover:text-purple-800 font-medium">← Back</button>
                    <button type="button" class="next-btn bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition font-medium">Next</button>
                </div>
            </div>

            <!-- STEP 3: Media & Contact -->
            <div id="step3" class="form-step hidden p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Media & Contact Information</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Image Upload -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Images</label>
                        <input type="file" name="images[]" multiple accept="image/*" class="w-full">
                    </div>

                    <!-- Seller Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Seller Type *</label>
                        <select name="seller_type" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                            <option value="">Select Seller Type</option>
                            @foreach(['owner'=>'Property Owner','broker'=>'Real Estate Broker','dealer'=>'Property Dealer','agent'=>'Real Estate Agent'] as $key => $label)
                                <option value="{{ $key }}" {{ old('seller_type', $house->seller_type) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Contact Phone *</label>
                        <input type="tel" name="contact_phone" value="{{ old('contact_phone', $house->contact_phone) }}" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100" required>
                    </div>

                    <!-- Contact Email -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email', $house->contact_email) }}" class="w-full px-4 py-3 border rounded-lg dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100">
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" class="prev-btn text-purple-600 hover:text-purple-800 font-medium">← Back</button>
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition font-medium">Update Listing</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const steps = document.querySelectorAll(".form-step");
    const nextBtns = document.querySelectorAll(".next-btn");
    const prevBtns = document.querySelectorAll(".prev-btn");

    // Make sure you have step indicators in your HTML, e.g.,
    // const step1Indicator = document.getElementById('step1-indicator');
    // const step2Indicator = document.getElementById('step2-indicator');
    // const step3Indicator = document.getElementById('step3-indicator');
const step1Indicator = document.getElementById('step1Indicator');
const step2Indicator = document.getElementById('step2Indicator');
const step3Indicator = document.getElementById('step3Indicator');

const indicators = [step1Indicator, step2Indicator, step3Indicator];


    let current = 0;

    function update() {
        steps.forEach((s,i)=>s.classList.toggle("hidden",i!==current));
        indicators.forEach((indicator, idx) => {
            indicator.classList.remove(
                "bg-gray-300",
                "bg-gray-600",
                "bg-gray-900",
                "bg-purple-600",
                "dark:bg-gray-600",
                "dark:bg-purple-400"
            );
            if (idx === current) {
                indicator.classList.add("bg-purple-600", "dark:bg-purple-400");
            } else if (idx < current) {
                indicator.classList.add("bg-gray-600", "dark:bg-gray-500");
            } else {
                indicator.classList.add("bg-gray-300", "dark:bg-gray-600");
            }
        });
    }

    nextBtns.forEach(b => b.addEventListener('click', e => { e.preventDefault(); current++; update(); }));
    prevBtns.forEach(b => b.addEventListener('click', e => { e.preventDefault(); current--; update(); }));

    update();
});
</script>

@endsection

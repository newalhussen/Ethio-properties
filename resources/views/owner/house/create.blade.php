
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create House Listing</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Add any other head stuff from your layout you need, e.g., Google Fonts, meta tags -->
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors">

<div class="min-h-screen py-8">
<div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center mb-8">
           <h6 class="text-3xl font-semi-bold text-center text-purple-800 dark:text-purple-400 mb-6">Please fill in your House details</h6>
                </div>

        <!-- Progress Bar -->
        <div class="flex justify-center mb-8">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <div id="step1Indicator" class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-semibold">1</div>
                    <span class="ml-2 text-sm font-medium text-gray-700">Basic Info</span>
                </div>
               <div id="line1" class="w-16 h-1 bg-gray-300 rounded transition-all"></div>
                <div class="flex items-center">
                    <div id="step2Indicator" class="w-10 h-10 bg-gray-300 dark:bg-gray-700
text-gray-600 dark:text-gray-300
 rounded-full flex items-center justify-center font-semibold">2</div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Location & Details</span>
                </div>
                <div id="line2" class="w-16 h-1 bg-gray-300 rounded transition-all"></div>
                <div class="flex items-center">
                    <div id="step3Indicator" class="w-10 h-10 bg-gray-300 dark:bg-gray-700
text-gray-600 dark:text-gray-300
 rounded-full flex items-center justify-center font-semibold">3</div>
                    <span class="ml-2 text-sm font-medium text-gray-500">Media & Contact</span>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/20
border-green-200 dark:border-green-800
text-green-600 dark:text-green-400
 rounded-lg">
                <p class="text-green-600 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 dark:bg-red-900/20
border-red-200 dark:border-red-800
text-red-600 dark:text-red-400
 rounded-lg">
                <p class="text-red-600 font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <!-- Form -->
        <form id="houseForm" action="{{ route('houses.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden transition-colors">
            @csrf
            
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
                    <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-200 mb-2">Basic Information</h2>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Title *</label>
                        <input type="text" name="title_en" value="{{ old('title_en') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="e.g., Beautiful 3-bedroom villa in Bole" required>
                        @error('title_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Title Amharic -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Title (Amharic)</label>
                        <input type="text" name="title_am" value="{{ old('title_am') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="አመልካች 3 የአልጋ ቤት በቦሌ">
                        @error('title_am') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Purpose -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Purpose *</label>
                        <select name="purpose" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Purpose</option>
                            <option value="for_sale" {{ old('purpose') == 'for_sale' ? 'selected' : '' }}>For Sale</option>
                            <option value="for_rent" {{ old('purpose') == 'for_rent' ? 'selected' : '' }}>For Rent</option>
                        </select>
                        @error('purpose') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Property Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Type *</label>
                        <select name="property_type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Property Type</option>
                            <option value="Villa" {{ old('property_type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                            <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                            <option value="Condominium" {{ old('property_type') == 'Condominium' ? 'selected' : '' }}>Condominium</option>
                            <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                            <option value="Guest House" {{ old('property_type') == 'Guest House' ? 'selected' : '' }}>Guest House</option>
                            <option value="Land / Plot" {{ old('property_type') == 'Land / Plot' ? 'selected' : '' }}>Land / Plot</option>
                        </select>
                        @error('property_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Price (ETB) *</label>
                        <input type="text" name="price" value="{{ old('price') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="e.g., 2,500,000" required>
                        @error('price') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Built Year -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Built Year</label>
                        <select name="built_year" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent">
                            <option value="">Select Year</option>
                            @for ($year = date('Y'); $year >= 1950; $year--)
                                <option value="{{ $year }}" {{ old('built_year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        @error('built_year') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bedrooms -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Bedrooms *</label>
                        <select name="bedrooms" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Bedrooms</option>
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('bedrooms') == $i ? 'selected' : '' }}>{{ $i == 0 ? 'Studio' : $i }}</option>
                            @endfor
                        </select>
                        @error('bedrooms') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Bathrooms *</label>
                        <select name="bathrooms" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Bathrooms</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('bathrooms') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('bathrooms') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Area -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Area (m²) *</label>
                        <input type="number" name="area_m2" value="{{ old('area_m2') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="e.g., 150" min="1" max="10000" required>
                        @error('area_m2') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Floors -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Number of Floors</label>
                        <select name="floors" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent">
                            <option value="">Select Floors</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('floors') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('floors') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Parking -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Parking Spaces</label>
                        <select name="parking" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent">
                            <option value="">Select Parking</option>
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('parking') == $i ? 'selected' : '' }}>{{ $i == 0 ? 'No Parking' : $i }}</option>
                            @endfor
                        </select>
                        @error('parking') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Additional Options -->
                    <div class="lg:col-span-2">
                        <div class="flex flex-wrap gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="negotiable" value="1" {{ old('negotiable') ? 'checked' : '' }} 
                                       class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-400">Price Negotiable</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="installment" value="1" {{ old('installment') ? 'checked' : '' }} 
                                       class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-700">Installment Available</span>
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="garage" value="1" {{ old('garage') ? 'checked' : '' }} 
                                       class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded focus:ring-purple-500">
                                <span class="ml-2 text-sm text-gray-700">Garage</span>
                            </label>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description *</label>
                        <textarea name="description_en" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                                  placeholder="Describe your property in detail..." required>{{ old('description_en') }}</textarea>
                        @error('description_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Description Amharic -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Description (Amharic)</label>
                        <textarea name="description_am" rows="4" 
                                  class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                                  placeholder="በዝርዝር የንብረትዎን ይግለጹ...">{{ old('description_am') }}</textarea>
                        @error('description_am') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="button" class="next-btn bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition duration-200 font-medium">
                        Next
                    </button>
                </div>
            </div>

            <!-- STEP 2: Location & Details -->
            <div id="step2" class="form-step hidden p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Location & Details</h2>
                                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Region -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Region *</label>
                        <select name="region" id="region" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Region</option>
                            <option value="Addis Ababa" {{ old('region') == 'Addis Ababa' ? 'selected' : '' }}>Addis Ababa</option>
                            <option value="Adama" {{ old('region') == 'Adama' ? 'selected' : '' }}>Adama</option>
                            <option value="Bahir Dar" {{ old('region') == 'Bahir Dar' ? 'selected' : '' }}>Bahir Dar</option>
                            <option value="Bishoftu" {{ old('region') == 'Bishoftu' ? 'selected' : '' }}>Bishoftu</option>
                            <option value="Dire Dawa" {{ old('region') == 'Dire Dawa' ? 'selected' : '' }}>Dire Dawa</option>
                            <option value="Gondar" {{ old('region') == 'Gondar' ? 'selected' : '' }}>Gondar</option>
                            <option value="Hawassa" {{ old('region') == 'Hawassa' ? 'selected' : '' }}>Hawassa</option>
                            <option value="Mekelle" {{ old('region') == 'Mekelle' ? 'selected' : '' }}>Mekelle</option>
                            <option value="Jimma" {{ old('region') == 'Jimma' ? 'selected' : '' }}>Jimma</option>
                            <option value="Harar" {{ old('region') == 'Harar' ? 'selected' : '' }}>Harar</option>
                        </select>
                        @error('region') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>


                    <!-- Subcity -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Subcity *</label>
                        <select name="subcity_en" id="subcity" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Subcity</option>
                        </select>
                        @error('subcity_en') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Full Address *</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="e.g., Bole Atlas, House No. 123" required>
                        @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Hidden fields for coordinates -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <!-- Map Container -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Location on Map (Optional)</label>
                        <div class="relative">
                            <div id="map" class="w-full h-96 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded-lg"></div>
                            <div class="absolute top-2 right-2 bg-white p-2 rounded shadow">
                                <button type="button" id="geocodeAddress" class="text-sm text-purple-600 hover:text-purple-800 font-medium">
                                    📍 Find Address
                                </button>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Click on the map or use "Find Address" to set the exact location (optional)</p>
                        @error('latitude') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        @error('longitude') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Amenities -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Amenities</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                            @php
                                $amenities = [
                                    'Parking', 'Balcony', 'Security', 'Elevator', 'Water Tank', 'Generator',
                                    'Internet', 'Furnished', 'Garden', 'Swimming Pool', 'Garage', 'Air Conditioning',
                                    'Laundry Room', 'Terrace', 'Storage', 'Pet Friendly', 'Near School', 'Near Hospital',
                                    'Near Shopping', 'Public Transport', 'Gym', 'Playground', '24/7 Security', 'Backup Power'
                                ];
                            @endphp
                            @foreach ($amenities as $amenity)
                                <label class="flex items-center">
                                    <input type="checkbox" name="amenities[]" value="{{ $amenity }}" 
                                           {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}
                                           class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded focus:ring-purple-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $amenity }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('amenities') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" class="prev-btn text-purple-600 hover:text-purple-800 font-medium">
                        ← Back
                    </button>
                    <button type="button" class="next-btn bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition duration-200 font-medium">
                        : Next
                    </button>
                </div>
            </div>

            <!-- STEP 3: Media & Contact -->
            <div id="step3" class="form-step hidden p-8">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-100 mb-2">Media & Contact Information</h2>
                    <p class="text-gray-600">Upload photos and provide contact details</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Image Upload -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Property Images *</label>
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
 rounded-lg p-8 text-center hover:border-purple-400 transition duration-200">
                            <input type="file" id="imageUpload" name="images[]" multiple accept="image/*" class="hidden" required>
                            <label for="imageUpload" class="cursor-pointer">
                                <div class="text-gray-400 mb-4">
                                    <svg class="mx-auto h-12 w-12" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                                <p class="text-lg font-medium text-gray-600 mb-2">Upload Property Images</p>
                                <p class="text-sm text-gray-500">Click to browse or drag and drop images here</p>
                                <p class="text-xs text-gray-400 mt-2">PNG, JPG, WEBP up to 5MB each (Max 10 images)</p>
                            </label>
                        </div>
                        <div id="imagePreview" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4"></div>
                        @error('images') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        @error('images.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Seller Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Seller Type *</label>
                        <select name="seller_type" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" required>
                            <option value="">Select Seller Type</option>
                            <option value="owner" {{ old('seller_type') == 'owner' ? 'selected' : '' }}>Property Owner</option>
                            <option value="broker" {{ old('seller_type') == 'broker' ? 'selected' : '' }}>Real Estate Broker</option>
                            <option value="dealer" {{ old('seller_type') == 'dealer' ? 'selected' : '' }}>Property Dealer</option>
                            <option value="agent" {{ old('seller_type') == 'agent' ? 'selected' : '' }}>Real Estate Agent</option>
                        </select>
                        @error('seller_type') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Contact Phone *</label>
                        <input type="tel" name="contact_phone" value="{{ old('contact_phone') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="e.g., +251 9XX XXX XXX" required>
                        @error('contact_phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Contact Email -->
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Contact Email</label>
                        <input type="email" name="contact_email" value="{{ old('contact_email') }}" 
                               class="w-full px-4 py-3 border border-gray-300 dark:border-gray-700
bg-white dark:bg-gray-900
text-gray-900 dark:text-gray-100
focus:ring-purple-500 focus:border-transparent
 focus:border-transparent" 
                               placeholder="your.email@example.com">
                        @error('contact_email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-between mt-8">
                    <button type="button" class="prev-btn text-purple-600 hover:text-purple-800 font-medium">
                        ← Back
                    </button>
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700 transition duration-200 font-medium">
                        🏠 Create Listing
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

<!-- Scripts -->
<!-- Google Maps API -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_key', 'AIzaSyBvOkBw9q2e2f3f3f3f3f3f3f3f3f3f3f3f') }}&libraries=places&callback=initMap"></script>

<script>
let map;
let marker;
let geocoder;
let currentStep = 1;

const locationData = {
  "Addis Ababa": ["Bole", "Kazanchis", "Lebu", "CMC", "Ayat", "Piassa", "Megenagna", "Summit", "Kality", "Akaki", "Nifas Silk", "Gullele", "Kirkos", "Arada", "Addis Ketema", "Yeka", "Kolfe Keranio", "Lideta"],
  "Adama": ["Wonji", "Kebele 03", "Kebele 05", "Geda", "Central", "Industrial Zone"],
  "Bahir Dar": ["Kebele 01", "Tana Area", "Dagmawi Minilik", "Abay Mado", "Central", "New Town"],
  "Bishoftu": ["Hora", "Kality", "Oda Nebe", "Adulala", "Central"],
  "Dire Dawa": ["Central", "Industrial Zone", "Residential", "Commercial"],
  "Gondar": ["Central", "New Town", "Residential", "Commercial"],
  "Hawassa": ["Central", "New Town", "Industrial", "Residential"],
  "Mekelle": ["Central", "Industrial", "Residential", "Commercial"],
  "Jimma": ["Central", "Industrial", "Residential", "Commercial"],
  "Harar": ["Central", "New Town", "Residential", "Commercial"]
};


document.addEventListener('DOMContentLoaded', function() {
    // Form step management
    const steps = document.querySelectorAll('.form-step');
    const indicators = [
        document.getElementById('step1Indicator'),
        document.getElementById('step2Indicator'),
        document.getElementById('step3Indicator')
    ];

const updateSteps = () => {
    steps.forEach((step, i) => {
        const indicator = indicators[i];

        // show correct form step
        step.classList.toggle('hidden', i + 1 !== currentStep);

        if (i + 1 <= currentStep) {
            // ACTIVE STEP
            indicator.classList.remove(
                'bg-gray-300',
                'text-gray-600',
                'dark:bg-gray-700',
                'dark:text-gray-300'
            );

            indicator.classList.add(
                'bg-purple-600',
                'text-white',
                'dark:bg-purple-500'
            );
        } else {
            // INACTIVE STEP
            indicator.classList.remove(
                'bg-purple-600',
                'text-white',
                'dark:bg-purple-500'
            );

            indicator.classList.add(
                'bg-gray-300',
                'text-gray-600',
                'dark:bg-gray-700',
                'dark:text-gray-300'
            );
        }
    });

    // progress lines
    document.getElementById('line1')
        .classList.toggle('bg-purple-600', currentStep >= 2);

    document.getElementById('line2')
        .classList.toggle('bg-purple-600', currentStep >= 3);
};


    // Navigation buttons
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (validateCurrentStep()) {
                if (currentStep < 3) {
                    currentStep++;
                    updateSteps();
                }
            }
        });
    });

    document.querySelectorAll('.prev-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 1) {
                currentStep--;
                updateSteps();
            }
        });
    });

    // Location dropdowns
const regionSelect = document.getElementById('region');
const subcitySelect = document.getElementById('subcity');


regionSelect.addEventListener('change', function() {
    const region = this.value;
    subcitySelect.innerHTML = '<option value="">Select Subcity</option>';

    if (region && locationData[region]) {
        locationData[region].forEach(subcity => {
            const option = document.createElement('option');
            option.value = subcity;
            option.textContent = subcity;
            subcitySelect.appendChild(option);
        });
    }
});

    // Image upload handling
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    let allFiles = [];

    imageUpload.addEventListener('change', handleImageUpload);
    
    // Drag and drop
    const dropZone = imageUpload.closest('.border-dashed');
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-purple-400', 'bg-purple-50');
    });
    
    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-purple-400', 'bg-purple-50');
    });
    
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-purple-400', 'bg-purple-50');
        const files = Array.from(e.dataTransfer.files).filter(file => file.type.startsWith('image/'));
        handleImageFiles(files);
    });

    function handleImageUpload(e) {
        const files = Array.from(e.target.files);
        handleImageFiles(files);
    }

    function handleImageFiles(files) {
        if (allFiles.length + files.length > 10) {
            alert('Maximum 10 images allowed');
            return;
        }

        allFiles = [...allFiles, ...files];
        updateImagePreview();
        updateFileInput();
    }

    function updateImagePreview() {
        imagePreview.innerHTML = '';
        allFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const div = document.createElement('div');
                div.className = 'relative group';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg">
                    <button type="button" class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition-opacity" onclick="removeImage(${index})">
                        ×
                    </button>
                `;
                imagePreview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        allFiles.forEach(file => dt.items.add(file));
        imageUpload.files = dt.files;
    }

    window.removeImage = function(index) {
        allFiles.splice(index, 1);
        updateImagePreview();
        updateFileInput();
    };

    // Form validation
    function validateCurrentStep() {
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            alert('Please fill in all required fields before proceeding.');
        }

        return isValid;
    }

    // Initialize map when step 2 is reached
    document.getElementById('step2').addEventListener('DOMNodeInserted', function() {
        if (currentStep === 2 && !map) {
            initMap();
        }
    });
    //  Initialize steps correctly on page load
updateSteps();

});

// Google Maps initialization
function initMap() {
    if (typeof google === 'undefined') {
        setTimeout(initMap, 100);
        return;
    }

    // Default location (Addis Ababa)
    const defaultLocation = { lat: 9.0192, lng: 38.7525 };
    
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
        center: defaultLocation
    });

    geocoder = new google.maps.Geocoder();
    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        draggable: true
    });

    // Update coordinates when marker is moved
    marker.addListener('dragend', function() {
        const position = marker.getPosition();
        document.getElementById('latitude').value = position.lat();
        document.getElementById('longitude').value = position.lng();
    });

    // Add marker when map is clicked
    map.addListener('click', function(event) {
        marker.setPosition(event.latLng);
        document.getElementById('latitude').value = event.latLng.lat();
        document.getElementById('longitude').value = event.latLng.lng();
    });

    // Geocode address button
    document.getElementById('geocodeAddress').addEventListener('click', function() {
        const address = document.getElementById('address').value;
        if (address) {
            geocoder.geocode({ address: address }, function(results, status) {
                if (status === 'OK') {
                    const location = results[0].geometry.location;
                    map.setCenter(location);
                    marker.setPosition(location);
                    document.getElementById('latitude').value = location.lat();
                    document.getElementById('longitude').value = location.lng();
                } else {
                    alert('Address not found. Please try a different address.');
                }
            });
        } else {
            alert('Please enter an address first.');
        }
    });

    // Set initial coordinates if they exist
    const lat = document.getElementById('latitude').value;
    const lng = document.getElementById('longitude').value;
    if (lat && lng) {
        const location = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        map.setCenter(location);
        marker.setPosition(location);
    }
}

// Price formatting
document.querySelector('input[name="price"]').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^\d]/g, '');
    if (value) {
        value = parseInt(value).toLocaleString();
        e.target.value = value;
    }
});
</script>

<script>
document.getElementById('houseForm').addEventListener('submit', function () {
    const priceInput = document.querySelector('input[name="price"]');
    if (priceInput) {
        priceInput.value = priceInput.value.replace(/,/g, '');
    }
});
</script>

</body>
</html>
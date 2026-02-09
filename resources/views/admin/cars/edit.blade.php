@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-6xl p-8">
    <h6 class="text-3xl font-semi-bold text-center text-purple-800 mb-6">
        Edit your car details
    </h6>

    <!-- Progress Bar -->
    <div class="flex justify-between mb-8">
        <div class="flex-1 text-center">
            <div id="step1Indicator" class="h-2 bg-purple-800 rounded-full transition-all"></div>
            <p class="text-sm mt-1">Car Details</p>
        </div>
        <div class="flex-1 text-center">
            <div id="step2Indicator" class="h-2 bg-gray-300 rounded-full transition-all"></div>
            <p class="text-sm mt-1">Seller Info</p>
        </div>
        <div class="flex-1 text-center">
            <div id="step3Indicator" class="h-2 bg-gray-300 rounded-full transition-all"></div>
            <p class="text-sm mt-1">Media Upload</p>
        </div>
    </div>

    <!-- Success & Error Messages -->
    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Updated!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#6b21a8'
                });
            });
        </script>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-600 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form id="carForm" action="{{ route('admin.cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg p-6">
        @csrf

        <!-- Validation Message -->
        <div id="validationMessage" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-600 font-medium">Please fill in all required fields before proceeding.</p>
        </div>

        <!-- STEP 1: Car Details -->
        <div id="step1" class="form-step">
            <h3 class="text-xl font-semibold mb-4 text-purple-700">Car Details</h3>

            <div class="mb-[10px] w-full">          
                <div class="mt-5 grid grid-cols-2 gap-4 w-full">
                    <input type="text" name="title" value="{{ old('title', $car->title) }}" class="border rounded px-3 py-2" placeholder="Title (English)" required>
                    <input type="text" name="title_am" value="{{ old('title_am', $car->title_am) }}" class="border rounded px-3 py-2" placeholder="Title (Amharic)">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <!-- Brand -->
                <select id="brand" name="brand" class="border rounded px-3 py-2" required>
                    <option value="">Brand *</option>
                    @php
                        $brands = ["Toyota","Nissan","Honda","Mazda","Subaru","Mitsubishi","Suzuki","Jetour","Lexus","Infiniti","Acura","Lada","Volkswagen","Mercedes-Benz","BMW","Audi","Porsche","Opel","Skoda","Ford","Chevrolet","GMC","Jeep","Cadillac","Lincoln","Chrysler","Tesla","Hyundai","Kia","Genesis","Peugeot","Renault","Citroen","Land Rover","Range Rover","Jaguar","Mini","Rolls-Royce","Bentley","Aston Martin","Fiat","Alfa Romeo","Ferrari","Lamborghini","Maserati","Volvo","Polestar","Geely","BYD","Chery","Great Wall Motors","MG","Tata","Mahindra","Proton","Perodua","Other"];
                    @endphp
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}" {{ old('brand', $car->brand) == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                    @endforeach
                </select>

                <!-- Model -->
                <select id="model" name="model" class="border rounded px-3 py-2" required>
                    <option value="{{ old('model', $car->model) }}">{{ old('model', $car->model ?? 'Select Model') }}</option>
                </select>

                <select name="body_type" class="border rounded px-3 py-2">
                    <option value="">Body Type</option>
                    @foreach(['Sedan','SUV','Hatchback','Pickup','Van','Coupe','Convertible','Truck','Bus','Other'] as $type)
                        <option value="{{ $type }}" {{ old('body_type', $car->body_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                    @endforeach
                </select>

                <select name="transmission" class="border rounded px-3 py-2" required>
                    <option value="">Transmission *</option>
                    @foreach(['Automatic','Manual','Other'] as $t)
                        <option value="{{ $t }}" {{ old('transmission', $car->transmission) == $t ? 'selected' : '' }}>{{ $t }}</option>
                    @endforeach
                </select>

                <input type="number" name="year" value="{{ old('year', $car->year) }}" class="border rounded px-3 py-2" placeholder="Year" required>

                <select name="fuel" class="border rounded px-3 py-2">
                    <option value="">Fuel Type</option>
                    @foreach(['Petrol','Diesel','Hybrid','Electric','Other'] as $f)
                        <option value="{{ $f }}" {{ old('fuel', $car->fuel) == $f ? 'selected' : '' }}>{{ $f }}</option>
                    @endforeach
                </select>

                <select name="color" class="border rounded px-3 py-2">
                    <option value="">Color</option>
                    @foreach(['White','Black','Silver','Gray','Blue','Red','Green','Yellow','Brown','Orange','Gold','Purple','Pink','Beige','Other'] as $color)
                        <option value="{{ $color }}" {{ old('color', $car->color) == $color ? 'selected' : '' }}>{{ $color }}</option>
                    @endforeach
                </select>

                <input type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}" class="border rounded px-3 py-2" placeholder="Mileage (e.g. 45,000)">
                <input type="text" name="engine_size" value="{{ old('engine_size', $car->engine_size) }}" class="border rounded px-3 py-2" placeholder="Engine Size (e.g. 1.8L, 2.0 Turbo)">

                <select name="drive_type" class="border rounded px-3 py-2">
                    <option value="">Drive Type</option>
                    @foreach(['FWD','RWD','AWD','4WD','Other'] as $drive)
                        <option value="{{ $drive }}" {{ old('drive_type', $car->drive_type) == $drive ? 'selected' : '' }}>{{ $drive }}</option>
                    @endforeach
                </select>

                <select name="condition" class="border rounded px-3 py-2">
                    <option value="">Condition</option>
                    @foreach(['New','Used','Foreign Used','Other'] as $condition)
                        <option value="{{ $condition }}" {{ old('condition', $car->condition) == $condition ? 'selected' : '' }}>{{ $condition }}</option>
                    @endforeach
                </select>

                <select name="seats" class="border rounded px-3 py-2">
                    <option value="">Seats</option>
                    @for ($i = 2; $i <= 9; $i++)
                        <option value="{{ $i }}" {{ old('seats', $car->seats) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                    <option value="Other">Other</option>
                </select>

                <input type="number" name="price" value="{{ old('price', $car->price) }}" class="border rounded px-3 py-2" placeholder="Price (e.g. 500000)" required>

                <select name="price_type" class="border rounded px-3 py-2" required>
                    @foreach(['fixed','negotiable','slightly_negotiable'] as $p)
                        <option value="{{ $p }}" {{ old('price_type', $car->price_type) == $p ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$p)) }}</option>
                    @endforeach
                </select>

                <select name="sale_rent" class="border rounded px-3 py-2" required>
                    <option value="">For Sale or Rent? *</option>
                    <option value="sale" {{ old('sale_rent', $car->sale_rent) == 'sale' ? 'selected' : '' }}>Sale</option>
                    <option value="rent" {{ old('sale_rent', $car->sale_rent) == 'rent' ? 'selected' : '' }}>Rent</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mt-5">
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" placeholder="Description (e.g. condition, features...)" required>{{ old('description', $car->description) }}</textarea>
            </div>

            <div class="mt-5">
                <textarea name="description_am" rows="3" class="w-full border rounded px-3 py-2" placeholder="Description (Amharic)">{{ old('description_am', $car->description_am) }}</textarea>
            </div>

            <!-- Additional Features -->
            <div class="mt-6">
                <button type="button" id="toggleFeatures" class="bg-purple-800 text-white px-6 py-2 rounded hover:bg-purple-900 transition">
                    + Additional Features
                </button>
                <div id="featuresList" class="hidden mt-3 grid grid-cols-3 gap-2 border rounded-lg p-4 bg-purple-50">
                    @php
                        $features = [
                            'Air Conditioning', 'Bluetooth', 'Sunroof', 'Leather Seats', 'Navigation System',
                            'Reverse Camera', 'Alloy Wheels', 'Cruise Control', 'Heated Seats', 
                            'Fog Lights', 'Parking Sensors', 'Touchscreen Display', 'USB Port', 
                            'Keyless Entry', 'Apple CarPlay / Android Auto', 'Rear AC Vents', 
                            'Power Windows', 'Tinted Windows', '360 Camera', 'Lane Assist'
                        ];
                    @endphp
                    @foreach ($features as $feature)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="features[]" value="{{ $feature }}" 
                                class="accent-purple-700"
                                {{ in_array($feature, old('features', $car->features ?? [])) ? 'checked' : '' }}>
                            <span>{{ $feature }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="text-right mt-6">
                <button type="button" class="next-btn bg-purple-800 text-white px-6 py-2 rounded hover:bg-purple-900">Next</button>
            </div>
        </div>

<!-- STEP 2: Seller Info -->
<div id="step2" class="form-step hidden">
    <h3 class="text-xl font-semibold mb-4 text-purple-700">Seller Information</h3>
    <div class="grid grid-cols-3 gap-4">

<!-- Seller Name -->
<input type="text" name="seller_name"
    value="{{ old('seller_name', $car->seller_name) }}"
    class="border rounded px-3 py-2"
    placeholder="Full Name" required>

<!-- Seller Type -->
<select name="seller_type" class="border rounded px-3 py-2" required>
    <option value="">Select Seller Type</option>
    @foreach(['Private','Broker','Dealership','Other'] as $s)
        <option value="{{ $s }}"
            {{ old('seller_type', $car->seller_type) == $s ? 'selected' : '' }}>
            {{ $s }}
        </option>
    @endforeach
</select>

<!-- Phone -->
<input type="text" name="contact_phone"
    value="{{ old('contact_phone', $car->contact_phone) }}"
    class="border rounded px-3 py-2"
    placeholder="Phone Number" required>

<!-- Email -->
<input type="email" name="contact_email"
    value="{{ old('contact_email', $car->contact_email) }}"
    class="border rounded px-3 py-2"
    placeholder="Email (optional)">

<!-- Address -->
<input type="text" name="seller_address"
    value="{{ old('seller_address', $car->seller_address) }}"
    class="border rounded px-3 py-2"
    placeholder="Address (optional)">
    </div>

    <div class="flex justify-between mt-6">
        <button type="button" class="prev-btn text-purple-700 hover:underline">← Back</button>
        <button type="button" class="next-btn bg-purple-800 text-white px-6 py-2 rounded hover:bg-purple-900">Next</button>
    </div>
</div>

        <!-- STEP 3: Media Upload -->
        <div id="step3" class="form-step hidden">
            <h3 class="text-xl font-semibold mb-4 text-purple-700">Upload Images & Video</h3>

            <!-- Show existing images -->
            @if($car->images)
                <div class="flex flex-wrap gap-3 mb-4">
                    @foreach($car->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="w-24 h-24 object-cover rounded shadow" alt="Car image">
                    @endforeach
                </div>
            @endif

            <div class="grid grid-cols-3 gap-4">
                <div class="border-2 border-dashed border-purple-400 rounded-lg p-6 text-center mb-4 col-span-3">
                    <input type="file" id="imageUpload" name="images[]" multiple class="hidden" accept="image/*">
                    <label for="imageUpload" class="cursor-pointer text-purple-700 font-semibold">Click or Drag & Drop New Images</label>
                    <div id="imagePreview" class="flex flex-wrap gap-3 mt-4"></div>
                </div>

                <div class="border-2 border-dashed border-purple-300 rounded-lg p-6 text-center mb-6 col-span-3">
                    <input type="file" id="videoUpload" name="video" class="hidden" accept="video/*">
                    <label for="videoUpload" class="cursor-pointer text-purple-700 font-semibold">Upload Optional Video</label>
                    <p class="text-gray-500 text-sm mt-1">Max size: 20MB</p>
                </div>
            </div>

            <div class="flex justify-between">
                <button type="button" class="prev-btn text-purple-700 hover:underline">← Back</button>
                <button type="submit" class="border-2 border-purple-800 text-purple-800 bg-white px-6 py-2 rounded hover:bg-purple-50 hover:shadow-md transition-all">
                    Update
                </button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // --- Step handling ---
    const steps = document.querySelectorAll(".form-step");
    const nextBtns = document.querySelectorAll(".next-btn");
    const prevBtns = document.querySelectorAll(".prev-btn");
    const indicators = [
        document.getElementById("step1Indicator"),
        document.getElementById("step2Indicator"),
        document.getElementById("step3Indicator")
    ];

    let currentStep = 0;

    function updateSteps() {
        steps.forEach((step, index) => {
            step.classList.toggle("hidden", index !== currentStep);
        });

        indicators.forEach((ind, index) => {
            if (index === currentStep) {
                ind.classList.remove("bg-gray-300");
                ind.classList.add("bg-purple-800");
            } else if (index < currentStep) {
                ind.classList.add("bg-purple-800");
            } else {
                ind.classList.remove("bg-purple-800");
                ind.classList.add("bg-gray-300");
            }
        });
    }

    function validateStep(step) {
        let valid = true;
        const requiredFields = steps[step].querySelectorAll("[required]");
        requiredFields.forEach(field => {
            if (!field.value.trim()) valid = false;
        });
        return valid;
    }

    nextBtns.forEach((btn, idx) => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            if (validateStep(currentStep)) {
                currentStep++;
                updateSteps();
                window.scrollTo({ top: 0, behavior: "smooth" });
            } else {
                document.getElementById("validationMessage").classList.remove("hidden");
                setTimeout(() => {
                    document.getElementById("validationMessage").classList.add("hidden");
                }, 3000);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener("click", e => {
            e.preventDefault();
            if (currentStep > 0) {
                currentStep--;
                updateSteps();
                window.scrollTo({ top: 0, behavior: "smooth" });
            }
        });
    });

    updateSteps();

    // --- Additional Features toggle ---
    const toggleFeaturesBtn = document.getElementById("toggleFeatures");
    const featuresList = document.getElementById("featuresList");

    if (toggleFeaturesBtn && featuresList) {
        toggleFeaturesBtn.addEventListener("click", function (e) {
            e.preventDefault();
            featuresList.classList.toggle("hidden");
            this.textContent = featuresList.classList.contains("hidden")
                ? "+ Additional Features"
                : "− Hide Features";
        });
    }

    // --- Image preview ---
    const imageUpload = document.getElementById("imageUpload");
    const imagePreview = document.getElementById("imagePreview");
    if (imageUpload && imagePreview) {
        imageUpload.addEventListener("change", function () {
            imagePreview.innerHTML = "";
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement("img");
                    img.src = e.target.result;
                    img.classList = "w-24 h-24 object-cover rounded shadow";
                    imagePreview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    }

    // --- Video file validation ---
    const videoUpload = document.getElementById("videoUpload");
    if (videoUpload) {
        videoUpload.addEventListener("change", function () {
            const file = this.files[0];
            if (file && file.size > 20 * 1024 * 1024) {
                alert("Video must be less than 20MB!");
                this.value = "";
            }
        });
    }
});
</script>
@endsection

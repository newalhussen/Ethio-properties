
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Optional: include your custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/cards.css') }}">
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

<div class="container mx-auto max-w-6xl p-8">
    <h6 class="text-3xl font-semi-bold text-center text-purple-800 dark:text-purple-400 mb-6">Please fill in your car details</h6>

    <!-- Progress Bar -->
    <div class="flex justify-between mb-8">
        <div class="flex-1 text-center">
            <div id="step1Indicator" class="h-2 rounded-full transition-all bg-purple-700 dark:bg-purple-400"></div>
            <p class="text-sm mt-1 text-gray-700 dark:text-gray-300">Car Details</p>
        </div>
        <div class="flex-1 text-center">
            <div id="step2Indicator" class="h-2 rounded-full transition-all bg-gray-300 dark:bg-gray-600"></div>
            <p class="text-sm mt-1 text-gray-700 dark:text-gray-300">Seller Info</p>
        </div>
        <div class="flex-1 text-center">
            <div id="step3Indicator" class="h-2 rounded-full transition-all bg-gray-300 dark:bg-gray-600"></div>
            <p class="text-sm mt-1 text-gray-700 dark:text-gray-300">Media Upload</p>
        </div>
    </div>

    <!-- Success / Error Messages -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-green-600 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-600 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Form -->
    <form id="carForm" action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
        @csrf
        
        <!-- Validation Message -->
        <div id="validationMessage" class="hidden mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-600 font-medium">Please fill in all required fields before proceeding.</p>
        </div>

        <!-- STEP 1: Car Details -->
        <div id="step1" class="form-step">
            <h3 class="text-xl font-semibold mb-4 text-purple-700">Car Details</h3>

              <div class=" mb-[10px] width: 100%">          
        <!-- Title (English & Amharic) -->
<div class="mt-5 grid grid-cols-2 gap-4 width: 100%">
    <input type="text" name="title" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  placeholder="Title (English)" required>
    <input type="text" name="title_am" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  placeholder="Title (Amharic)">
</div>
</div>
            <div class="grid grid-cols-3 gap-4">
      <!-- brand -->
                <select id="brand" name="brand" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  required>
                    <option value="">Brand *</option>
                    <!-- Japanese -->
                    <option value="Toyota">Toyota</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Honda">Honda</option>
                    <option value="Mazda">Mazda</option>
                    <option value="Subaru">Subaru</option>
                    <option value="Mitsubishi">Mitsubishi</option>
                    <option value="Suzuki">Suzuki</option>

                    <option value="Jetour">Jetour</option>

                    <option value="Lexus">Lexus</option>
                    <option value="Infiniti">Infiniti</option>
                    <option value="Acura">Acura</option>
                    <!-- Russian -->
                    <option value="Lada">Lada</option>
                    <!-- German -->
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Mercedes-Benz">Mercedes-Benz</option>
                    <option value="BMW">BMW</option>
                    <option value="Audi">Audi</option>
                    <option value="Porsche">Porsche</option>
                    <option value="Opel">Opel</option>
                    <option value="Skoda">Skoda</option>
                    <!-- American -->
                    <option value="Ford">Ford</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="GMC">GMC</option>
                    <option value="Jeep">Jeep</option>
                    <option value="Cadillac">Cadillac</option>
                    <option value="Lincoln">Lincoln</option>
                    <option value="Chrysler">Chrysler</option>
                    <option value="Tesla">Tesla</option>
                    <!-- Korean -->
                    <option value="Hyundai">Hyundai</option>
                    <option value="Kia">Kia</option>
                    <option value="Genesis">Genesis</option>
                    <!-- French -->
                    <option value="Peugeot">Peugeot</option>
                    <option value="Renault">Renault</option>
                    <option value="Citroen">Citroen</option>
                    <!-- British -->
                    <option value="Land Rover">Land Rover</option>
                    <option value="Range Rover">Range Rover</option>
                    <option value="Jaguar">Jaguar</option>
                    <option value="Mini">Mini</option>
                    <option value="Rolls-Royce">Rolls-Royce</option>
                    <option value="Bentley">Bentley</option>
                    <option value="Aston Martin">Aston Martin</option>
                    <!-- Italian -->
                    <option value="Fiat">Fiat</option>
                    <option value="Alfa Romeo">Alfa Romeo</option>
                    <option value="Ferrari">Ferrari</option>
                    <option value="Lamborghini">Lamborghini</option>
                    <option value="Maserati">Maserati</option>
                    <!-- Swedish -->
                    <option value="Volvo">Volvo</option>
                    <option value="Polestar">Polestar</option>
                    <!-- Chinese -->
                    <option value="Geely">Geely</option>
                    <option value="BYD">BYD</option>
                    <option value="Chery">Chery</option>
                    <option value="Great Wall Motors">Great Wall Motors</option>
                    <option value="MG">MG</option>
                    <!-- Indian -->
                    <option value="Tata">Tata</option>
                    <option value="Mahindra">Mahindra</option>
                    <!-- Malaysian -->
                    <option value="Proton">Proton</option>
                    <option value="Perodua">Perodua</option>
                    <!-- Other -->
                    <option value="Other">Other</option>
                </select>

                <!-- Model -->
<select id="model" name="model"
    class="border rounded px-3 py-2
           bg-gray-100 dark:bg-gray-700
           text-gray-900 dark:text-gray-100
           border-gray-300 dark:border-gray-600
           cursor-not-allowed
           focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-gray-500"
    disabled required>
    <option value="">Select Model *</option>
</select>


                <select name="body_type" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" ">
                    <option value="">Body Type</option>
                    <option value="Sedan">Sedan</option>
                    <option value="SUV">SUV</option>
                    <option value="Hatchback">Hatchback</option>
                    <option value="Pickup">Pickup</option>
                    <option value="Van">Van</option>
                    <option value="Coupe">Coupe</option>
                    <option value="Convertible">Convertible</option>
                    <option value="Truck">Truck</option>
                    <option value="Bus">Bus</option>
                    <option value="Other">Other</option>
                </select>

                <select name="transmission" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Transmission *</option>
                    <option>Automatic</option>
                    <option>Manual</option>
                    <option>Other</option>
                </select>

                <input type="number" name="year" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Year" required>

                <select name="fuel" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500">
                    <option value="">Fuel Type</option>
                    <option>Petrol</option>
                    <option>Diesel</option>
                    <option>Hybrid</option>
                    <option>Electric</option>
                    <option>Other</option>
                </select>

                <!-- Color Dropdown -->
                <select name="color" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500">
                    <option value="">Color</option>
                    <option value="White">⚪ White</option>
                    <option value="Black">⚫ Black</option>
                    <option value="Silver">⚪ Silver</option>
                    <option value="Gray">⚫ Gray</option>
                    <option value="Blue">🔵 Blue</option>
                    <option value="Red">🔴 Red</option>
                    <option value="Green">🟢 Green</option>
                    <option value="Yellow">🟡 Yellow</option>
                    <option value="Brown">🟤 Brown</option>
                    <option value="Orange">🟠 Orange</option>
                    <option value="Gold">🟡 Gold</option>
                    <option value="Purple">🟣 Purple</option>
                    <option value="Pink">🌸 Pink</option>
                    <option value="Beige">🟤 Beige</option>
                    <option value="Other">Other</option>
                </select>

                <input type="number" name="mileage" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Mileage (e.g. 45,000)">
                <input type="text" name="engine_size" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Engine Size (e.g. 1.8L, 2.0 Turbo)">

                <select name="drive_type" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-50">
                    <option value="">Drive Type</option>
                    <option value="FWD">FWD</option>
                    <option value="RWD">RWD</option>
                    <option value="AWD">AWD</option>
                    <option value="4WD">4WD</option>
                    <option value="Other">Other</option>
                </select>

                <select name="condition" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500">
                    <option value="">Condition</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                    <option value="Foreign Used">Foreign Used</option>
                    <option value="Other">Other</option>
                </select>

                <select name="seats" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" >
                    <option value="">Seats</option>
                    @for ($i = 2; $i <= 9; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    <option value="Other">Other</option>
                </select>

                <!-- Price -->
                <input type="number" name="price" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  placeholder="Price (e.g. 500000)" required>

                <select name="price_type" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  required>
                    <option value="fixed">Fixed</option>
                    <option value="negotiable">Negotiable</option>
                    <option value="slightly_negotiable">Slightly Negotiable</option>
                </select>

                <select name="sale_rent" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500"  required>
                    <option value="">For Sale or Rent? *</option>
                    <option value="sale">Sale</option>
                    <option value="rent">Rent</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mt-5">
                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" placeholder="Description (e.g. condition, features...)" required></textarea>
            </div>


<!-- Description (Amharic) -->
<div class="mt-5">
    <textarea name="description_am" rows="3" class="w-full border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600" placeholder="Description (Amharic)"></textarea>
</div>


<!-- Additional Features -->
<div class="mt-6">
    <button type="button" id="toggleFeatures" class="bg-purple-800 text-white px-6 py-2 rounded hover:bg-purple-900 transition">
        + Additional Features
    </button>
    <div id="featuresList" class="hidden mt-3 grid grid-cols-3 gap-2 border rounded-lg p-4
        bg-purple-50 dark:bg-gray-800 border-gray-300 dark:border-gray-700">
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
            <label class="flex items-center space-x-2 text-gray-900 dark:text-gray-200">
                <input type="checkbox" name="features[]" value="{{ $feature }}" class="accent-purple-700">
                <span>{{ $feature }}</span>
            </label>
        @endforeach
    </div>
</div>


            <div class="text-right mt-6">
                <button type="button" class="next-btn bg-purple-700 dark:bg-purple-400
       text-white dark:text-gray-900
       px-6 py-2 rounded
       hover:bg-purple-800 dark:hover:bg-purple-300 transition"
>Next</button>
            </div>
        </div>

        <!-- STEP 2: Seller Info -->
        <div id="step2" class="form-step hidden">
            <h3 class="text-xl font-semibold mb-4 text-purple-700">Seller Information</h3>
            <div class="grid grid-cols-3 gap-4">
                <input type="text" name="name" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Full Name" required>
                <select name="seller_type" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" required>
                    <option value="">Select Seller Type</option>
                    <option value="Private">Private</option>
                    <option value="Broker">Broker</option>
                    <option value="Dealership">Dealership</option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" name="phone" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Phone Number" required>
                <input type="email" name="email" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-500" placeholder="Email (optional)">
                <input type="text" name="address" class="border rounded px-3 py-2 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-purple-505" placeholder="Address (optional)">
            </div>
            <div class="flex justify-between mt-6">
                <button type="button" class="prev-btn text-purple-700 hover:underline">← Back</button>
                <button type="button" class="next-btn bg-purple-700 dark:bg-purple-400 
       text-white dark:text-gray-900
       px-6 py-2 rounded
       hover:bg-purple-800 dark:hover:bg-purple-300 transition"
>Next</button>
            </div>
        </div>

        <!-- STEP 3: Media Upload -->
        <div id="step3" class="form-step hidden">
            <h3 class="text-xl font-semibold mb-4 text-purple-700">Upload Images & Video</h3>
            <div class="grid grid-cols-3 gap-4">

                <div class="border-2 border-dashed border-purple-400 rounded-lg p-6 text-center mb-4 col-span-3">
                    <input type="file" id="imageUpload" name="images[]" multiple class="hidden" accept="image/*">
                    <label for="imageUpload" class="cursor-pointer text-purple-700 font-semibold">Click or Drag & Drop Images</label>
                    <div id="imagePreview" class="flex flex-wrap gap-3 mt-4"></div>
                </div>

                <div class="border-2 border-dashed border-purple-300 rounded-lg p-6 text-center mb-6 col-span-3">
                    <input type="file" id="videoUpload" name="video" class="hidden" accept="video/*">
                    <label for="videoUpload" class="cursor-pointer text-purple-700 font-semibold">Upload Optional Video</label>
                    <p class="text-gray-500 text-sm mt-1">Max size: 20MB</p>
                </div>

            </div>
            <div class="flex justify-between">
                <button type="button" class="prev-btn text-purple-700 dark:text-purple-400 hover:underline">← Back</button>
                <button type="submit" class="border-2 border-purple-800 text-purple-800 bg-white px-6 py-2 rounded hover:bg-purple-50 hover:shadow-md transition-all">Submit</button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const steps = document.querySelectorAll('.form-step');
    const indicators = [
        document.getElementById('step1Indicator'),
        document.getElementById('step2Indicator'),
        document.getElementById('step3Indicator')
    ];

    const updateSteps = () => {
        steps.forEach((step, i) => {
            step.classList.toggle('hidden', i + 1 !== currentStep);
            indicators[i].classList.toggle('bg-purple-800', i + 1 <= currentStep);
            indicators[i].classList.toggle('bg-gray-300', i + 1 > currentStep);
        });
    };

    document.querySelectorAll('.next-btn').forEach(b => b.addEventListener('click', () => {
        if (validateCurrentStep() && currentStep < totalSteps) {
            currentStep++;
            updateSteps();
        }
    }));
    document.querySelectorAll('.prev-btn').forEach(b => b.addEventListener('click', () => {
        if (currentStep > 1) currentStep--, updateSteps();
    }));

    // Validation function
    function validateCurrentStep() {
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const requiredFields = currentStepElement.querySelectorAll('[required]');
        let isValid = true;
        const validationMessage = document.getElementById('validationMessage');

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('border-red-500');
                isValid = false;
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!isValid) {
            validationMessage.classList.remove('hidden');
            setTimeout(() => {
                validationMessage.classList.add('hidden');
            }, 5000);
        } else {
            validationMessage.classList.add('hidden');
        }

        return isValid;
    }

    // Additional Features Toggle
    const toggleBtn = document.getElementById('toggleFeatures');
    const featuresList = document.getElementById('featuresList');
    toggleBtn.addEventListener('click', () => {
        featuresList.classList.toggle('hidden');
        toggleBtn.textContent = featuresList.classList.contains('hidden')
            ? '+ Additional Features'
            : '− Hide Features';
    });

    // brand-> Model dynamic with Ethiopian-common models
    const brandSelect = document.getElementById('brand');
    const modelSelect = document.getElementById('model');
    const models = {
        Toyota: ['Corolla', 'Camry', 'Hilux', 'Yaris', 'RAV4', 'Land Cruiser', 'Vitz', 'Other'],
        Nissan: ['Sunny', 'X-Trail', 'Patrol', 'Navara', 'Other'],
        Honda: ['Civic', 'Accord', 'CR-V', 'Fit', 'HR-V', 'Other'],
        Mazda: ['3', '6', 'CX-5', 'CX-9', 'Other'],
        Subaru: ['Impreza', 'Forester', 'Outback', 'Other'],
        Mitsubishi: ['Lancer', 'Outlander', 'Pajero', 'Other'],
        Suzuki: ['Swift', 'Dzire','Celerio', 'Jimny', 'Vitara', 'Alto', 'Ciaz', 'Other'],
        Lada: ['Niva', 'Other'],
        Jetour: ['X70', 'X90', 'T90', 'Other'],

        Lexus: ['RX', 'ES', 'LX', 'NX', 'Other'],
        Infiniti: ['Q50', 'QX60', 'Other'],
        Acura: ['MDX', 'RDX', 'Other'],
        Volkswagen: ['Golf', 'Passat', 'Tiguan', 'Jetta', 'Other'],
        'Mercedes-Benz': ['C-Class', 'E-Class', 'GLA', 'GLC', 'Other'],
        BMW: ['3 Series', '5 Series', 'X3', 'X5', 'Other'],
        Audi: ['A3', 'A4', 'A6', 'Q5', 'Other'],
        Porsche: ['Cayenne', '911', 'Other'],
        Opel: ['Corsa', 'Astra', 'Other'],
        Skoda: ['Octavia', 'Superb', 'Other'],
        Ford: ['Focus', 'Fiesta', 'Ranger', 'Mustang', 'Explorer', 'Other'],
        Chevrolet: ['Spark', 'Cruze', 'Trailblazer', 'Silverado', 'Other'],
        GMC: ['Sierra', 'Yukon', 'Other'],
        Jeep: ['Wrangler', 'Grand Cherokee', 'Other'],
        Cadillac: ['Escalade', 'CTS', 'Other'],
        Lincoln: ['Navigator', 'MKZ', 'Other'],
        Chrysler: ['300', 'Pacifica', 'Other'],
        Tesla: ['Model S', 'Model 3', 'Model X', 'Model Y', 'Other'],
        Hyundai: ['Accent', 'Elantra', 'Tucson', 'Sonata', 'Santa Fe', 'Other'],
        Kia: ['Rio', 'Sportage', 'Seltos', 'Sorento', 'Other'],
        Genesis: ['G70', 'G80', 'G90', 'Other'],
        Peugeot: ['208', '308', '3008', 'Other'],
        Renault: ['Clio', 'Megane', 'Koleos', 'Other'],
        Citroen: ['C3', 'C4', 'Other'],
        'Land Rover': ['Discovery', 'Range Rover', 'Other'],
        Jaguar: ['XE', 'XF', 'F-Pace', 'Other'],
        Mini: ['Cooper', 'Countryman', 'Other'],
        'Rolls-Royce': ['Phantom', 'Ghost', 'Other'],
        Bentley: ['Continental', 'Flying Spur', 'Other'],
        'Aston Martin': ['DB11', 'Vantage', 'Other'],
        Fiat: ['500', 'Panda', 'Other'],
        'Alfa Romeo': ['Giulia', 'Stelvio', 'Other'],
        Ferrari: ['488', 'F8', 'Other'],
        Lamborghini: ['Huracan', 'Aventador', 'Other'],
        Maserati: ['Ghibli', 'Levante', 'Other'],
        Volvo: ['XC60', 'XC90', 'S60', 'Other'],
        Polestar: ['2', 'Other'],
        Geely: ['Coolray', 'Emgrand', 'Other'],
        BYD: ['Tang', 'Song', 'Other'],
        Chery: ['Tiggo', 'Arrizo', 'Other'],
        'Great Wall Motors': ['Haval H6', 'Other'],
        MG: ['ZS', 'Hector', 'Other'],
        Tata: ['Nexon', 'Other'],
        Mahindra: ['Thar', 'Other'],
        Proton: ['Saga', 'X70', 'Other'],
        Perodua: ['Myvi', 'Other'],
        Other: ['Other']
    };

    brandSelect.addEventListener('change', () => {
        modelSelect.innerHTML = '<option value="">Select Model</option>';
        const selectedBrand = brandSelect.value;
        if (models[selectedBrand]) {
            models[selectedBrand].forEach(model => {
                const opt = document.createElement('option');
                opt.value = model;
                opt.textContent = model;
                modelSelect.appendChild(opt);
            });
            modelSelect.disabled = false;
            modelSelect.classList.remove('bg-gray-100', 'cursor-not-allowed');
        } else {
            modelSelect.disabled = true;
            modelSelect.classList.add('bg-gray-100', 'cursor-not-allowed');
        }
    });

    // Image upload preview
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const dropZone = imageUpload.closest('.border-dashed');
    let allFiles = [];
    function FileListItems(files) {
        const dt = new DataTransfer();
        files.forEach(f => dt.items.add(f));
        return dt.files;
    }
    function showPreview() {
        imagePreview.innerHTML = '';
        allFiles.forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.createElement('div');
                wrap.classList = 'relative inline-block';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList = 'w-24 h-24 object-cover rounded shadow';
                const remove = document.createElement('button');
                remove.innerHTML = '✕';
                remove.classList = 'absolute top-1 right-1 bg-red-600 text-white rounded-full w-5 h-5 text-xs';
                remove.addEventListener('click', () => {
                    allFiles.splice(i, 1);
                    imageUpload.files = FileListItems(allFiles);
                    showPreview();
                });
                wrap.appendChild(img);
                wrap.appendChild(remove);
                imagePreview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
    }
    imageUpload.addEventListener('change', e => {
        allFiles = [...allFiles, ...Array.from(e.target.files)];
        imageUpload.files = FileListItems(allFiles);
        showPreview();
    });
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('bg-purple-50'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('bg-purple-50'));
    dropZone.addEventListener('drop', e => {
        e.preventDefault();
        dropZone.classList.remove('bg-purple-50');
        allFiles = [...allFiles, ...Array.from(e.dataTransfer.files)];
        imageUpload.files = FileListItems(allFiles);
        showPreview();
    });
});
</script>

</body>
</html>
@extends('layouts.app')

@section('content')
@php
  $slides = isset($imageUrls) && is_array($imageUrls) && count($imageUrls) ? $imageUrls : [];
@endphp

<div class="max-w-7xl mx-auto px-4 py-1">

    <!-- ==== TOP SECTION (2/3 Slider + 1/3 Contact Card) ==== -->
    <div class="grid md:grid-cols-4 gap-8 relative">

        <!-- LEFT: SLIDER (2/3) -->
        <div class="md:col-span-3">
            <div
                x-data="{
                    current: 0,
                    slides: @js($imageUrls),
                    timer: null,

                    start() {
                      if (this.slides.length > 1) {
                        this.timer = setInterval(() => this.next(), 5000);
                      }
                    },
                    stop() { if (this.timer) clearInterval(this.timer); },
                    next() { this.current = (this.current + 1) % this.slides.length; },
                    prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length; },
                }"
                x-init="start()"
                @mouseenter="stop()"
                @mouseleave="start()"
               class="relative w-full h-[55vh] md:h-[80vh] overflow-hidden rounded-2xl bg-gray-200">

                <!-- Slider track -->
                <div
                    class="flex transition-transform duration-700 ease-in-out h-full"
                    :style="`transform: translateX(-${current * 100}%);`"
                >
                    <template x-for="(slide, i) in slides" :key="i">
                        <img :src="slide" class="w-full h-full object-cover flex-shrink-0" alt="Car image">
                    </template>

                    <!-- fallback -->
                    <template x-if="!slides.length">
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#440057] to-[#6a0080]">
                            <div class="text-center text-white">
                                <div class="text-6xl mb-4">🚗</div>
                                <h3 class="text-2xl font-semibold">No Images Available</h3>
                                <p class="text-lg opacity-90">Images will be displayed here</p>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                <!-- Arrows -->
                <template x-if="slides.length > 1">
                    <div>
                        <button
                            @click="prev()"
                            class="absolute left-5 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white px-4 py-3 rounded-full backdrop-blur-sm transition"
                        >‹</button>

                        <button
                            @click="next()"
                            class="absolute right-5 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white px-4 py-3 rounded-full backdrop-blur-sm transition"
                        >›</button>
                    </div>
                </template>

                <!-- Dots -->
                <template x-if="slides.length > 1">
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-3">
                        <template x-for="(slide, i) in slides" :key="i">
                            <div
                                @click="current = i"
                                class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                                :class="i === current ? 'bg-white scale-125' : 'bg-gray-400/70'"
                            ></div>
                        </template>
                    </div>
                </template>
            </div>
        </div>

        <!-- RIGHT: Sticky Sidebar -->
        <div class="md:col-span-1">
            <div class="relative">
                <div class="md:sticky md:top-20 md:right-5 md:w-full md:max-w-[300px] space-y-4">
                    <!-- ======= buttons ======= -->
                    <div class="bg-white p-2 max-w-lg mx-auto">
                        <!-- SEE PHONE NUMBER BUTTON -->
                        <div x-data="{ showPhone: false }">
                            <button
                                @click="showPhone = !showPhone"
                                class="w-full py-1.5 bg-green-600 text-white font-semibold hover:bg-green-700 transition flex justify-center items-center gap-2"
                            >
                                <template x-if="!showPhone">
                                    <span class="flex items-center gap-2">
                                        <span>📞</span>
                                        <span>See Phone Number</span>
                                    </span>
                                </template>

                                <template x-if="showPhone">
                                    <span class="font-bold">
                                        {{ $car->contact_phone ?? 'No phone number provided' }}
                                    </span>
                                </template>
                            </button>
                        </div>

                        <!--request call back Button -->
                        <button 
                            id="callbackToggleBtn"
                            class="w-full mt-1 py-1 bg-red-600 text-white font-semibold hover:bg-red-700 transition flex justify-center items-center "
                        >
                            Request Call Back
                        </button>

                        <!-- Hidden Form -->
                        <div 
                            id="callbackFormWrapper" 
                            class="mt-4 hidden opacity-0 translate-y-2 transition-all duration-300"
                        >
                            <form action="{{ route('owner.messages.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $car->id }}">
                                <input type="hidden" name="post_type" value="car">
                                <input type="hidden" name="type" value="callback">

                                <input 
                                    type="text" 
                                    name="name" 
                                    placeholder="Your Name"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800"
                                >

                                <input 
                                    type="text" 
                                    name="phone" 
                                    placeholder="Phone Number"
                                    required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800"
                                >

                                <button 
                                    type="submit"
                                    class="w-full py-3 bg-slate-800 text-white rounded-xl font-semibold hover:bg-slate-900 transition"
                                >
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Contact Seller Form -->
                    <div class="bg-white/90 backdrop-blur shadow-sm rounded-2xl p-3 border border-gray-200">
                        <h3 class="text-lg font-semibold mb-4 text-slate-800">Contact Seller</h3>

                        <form action="{{ route('owner.messages.store') }}" method="POST" class="space-y-1">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $car->id }}">
                            <input type="hidden" name="post_type" value="car">
                            <input type="hidden" name="type" value="inquiry">

                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Name</label>
                                <input type="text" name="name" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-slate-800">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Email</label>
                                <input type="email" name="email" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-slate-800">
                            </div>

                            <div>
                                <label class="block text-sm text-gray-600 mb-1">Message</label>
                                <textarea name="content" required rows="3"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-slate-800"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-slate-800 text-white rounded-lg px-4 py-2 font-semibold hover:bg-slate-900 transition">
                                Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==== TITLE + DETAILS ==== -->
    <div class="max-w-4xl mt-10">
        <h1 class="text-3xl font-bold text-slate-900">{{ $car->title ?: $car->brand . ' ' . $car->model }}</h1>
        <p class="text-gray-600 mb-4">{{ $car->brand }} {{ $car->model }} • {{ $car->year }}</p>

        <div class="flex items-center flex-wrap gap-3 mb-6">
            <span class="text-2xl font-bold text-gray-900">ETB {{ number_format($car->price) }}</span>
            <span class="text-lg text-slate-700">({{ ucfirst($car->price_type) }})</span>
            <span class="px-3 py-1 bg-cyan-100 text-cyan-800 rounded-full text-sm font-medium">
                {{ $car->sale_rent == 'sale' ? 'For Sale' : 'For Rent' }}
            </span>
        </div>

        @if($car->description)
            <p class="text-gray-700 leading-relaxed mb-8">{{ $car->description }}</p>
        @endif

        <!-- Car Details Stats -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10">
            @php
                $stats = [
                    'Year' => $car->year,
                    'Transmission' => $car->transmission,
                    'Body Type' => $car->body_type,
                    'Color' => $car->color,
                    'Fuel Type' => $car->fuel,
                    'Engine Size' => $car->engine_size,
                    'Mileage' => $car->mileage ? number_format($car->mileage) . ' km' : 'N/A',
                    'Seats' => $car->seats ?: 'N/A',
                    'Doors' => $car->doors ?: 'N/A',
                    'Drive Type' => $car->drive_type,
                    'Condition' => $car->condition
                ];
            @endphp

            @foreach($stats as $label => $value)
                <div class="bg-gray-50 p-4 rounded-lg text-center border border-gray-200">
                    <p class="text-gray-500 text-sm">{{ $label }}</p>
                    <p class="text-lg font-semibold text-slate-800">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        <!-- Video Section -->
        @if($car->video)
        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4 text-slate-900">Car Video</h2>
            <div class="relative w-full h-72 md:h-80 rounded-xl overflow-hidden">
                <video 
                    class="w-full h-full object-cover" 
                    controls 
                    poster="{{ $firstImage ?? 'https://placehold.co/800x600?text=Car+Video' }}"
                >
                    <source src="{{ asset('storage/' . $car->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        @endif
    </div>

    <!-- Similar Cars -->
    <div class="mt-8">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Similar Cars</h2>
        <div class="grid md:grid-cols-4 gap-4">
           @php
    use App\Models\Car;

    // 1. Highest priority: same brand
    $similarCars = Car::where('id', '!=', $car->id)
        ->where('brand', $car->brand)
        ->latest()
        ->take(8)
        ->get();

    // 2. If less than 8, fill with similar attributes
    if ($similarCars->count() < 8) {
        $needed = 8 - $similarCars->count();

        $extraCars = Car::where('id', '!=', $car->id)
            ->whereNotIn('id', $similarCars->pluck('id'))
            ->where(function ($q) use ($car) {
                $q->where('body_type', $car->body_type)
                  ->orWhere('fuel', $car->fuel)
                  ->orWhere('transmission', $car->transmission)
                  ->orWhereBetween('year', [$car->year - 2, $car->year + 2])
                  ->orWhereBetween('price', [
                      $car->price * 0.85,
                      $car->price * 1.15
                  ]);
            })
            ->latest()
            ->take($needed)
            ->get();

        $similarCars = $similarCars->merge($extraCars);
    }
@endphp

            @foreach($similarCars as $similar)
                @php
                    $simImg = 'https://placehold.co/1200x800?text=Car';
                    if (!empty($similar->images) && is_array($similar->images) && isset($similar->images[0])) {
                        $p = ltrim($similar->images[0], '/');
                        if (preg_match('/^https?:\/\//i', $p)) {
                            $simImg = $p;
                        } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($p)) {
                            $simImg = asset('storage/' . $p);
                        } elseif (file_exists(public_path($p))) {
                            $simImg = asset($p);
                        } elseif (file_exists(public_path('uploads/' . $p))) {
                            $simImg = asset('uploads/' . $p);
                        }
                    }
                @endphp
                
                <a href="{{ route('user.cars.show', $similar->id) }}" 
                   class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition block">
                    <img src="{{ $simImg }}" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-900 text-lg">{{ $similar->brand }} {{ $similar->model }}</h3>
                        <p class="text-gray-600 text-sm">{{ $similar->year }} • {{ $similar->transmission }} • {{ $similar->fuel }}</p>
                        <div class="flex justify-between items-center mt-2">
                            <p class="font-bold text-slate-900 text-lg">ETB {{ number_format($similar->price) }}</p>
                            <span class="text-sm text-gray-500">{{ $similar->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("callbackToggleBtn");
    const form = document.getElementById("callbackFormWrapper");

    btn.addEventListener("click", () => {
        const isHidden = form.classList.contains("hidden");

        if (isHidden) {
            form.classList.remove("hidden");
            setTimeout(() => {
                form.classList.remove("opacity-0", "translate-y-2");
            }, 10);
        } else {
            form.classList.add("opacity-0", "translate-y-2");
            setTimeout(() => {
                form.classList.add("hidden");
            }, 300);
        }
    });
});
</script>
@endsection
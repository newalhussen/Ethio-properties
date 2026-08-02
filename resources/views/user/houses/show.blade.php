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
                class="relative w-full h-[50vh] md:h-[80vh] overflow-hidden rounded-2xl bg-gray-200"
            >
                <!-- Slider track -->
                <div
                    class="flex transition-transform duration-700 ease-in-out h-full"
                    :style="`transform: translateX(-${current * 100}%);`"
                >
                    <template x-for="(slide, i) in slides" :key="i">
                        <img :src="slide" class="w-full h-full md:object-cover object-contain flex-shrink-0">
                    </template>

                    <!-- fallback -->
                    <template x-if="!slides.length">
                        <img src='https://placehold.co/1200x800?text=No+Image' class="w-full h-full object-cover">
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

        <!-- RIGHT:  - Sticky -->
        <div class="md:col-span-1">
          <div class="relative">
            <div class="md:sticky md:top-20 md:right-5 md:w-full md:max-w-[300px] space-y-4">
            <!-- ======= buttons ======= -->
<div class="bg-white p-2  max-w-lg mx-auto">
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
                {{ $house->contact_phone ?? 'No phone number provided' }}
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

        <input type="hidden" name="post_id" value="{{ $house->id }}">
        <input type="hidden" name="post_type" value="house">
        <input type="hidden" name="type" value="callback">

        <input 
            type="text" 
            name="name" 
            placeholder="Your Name"
            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800"
            required
        >

        <input 
            type="text" 
            name="phone" 
            placeholder="Phone Number"
            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-slate-800 focus:border-slate-800"
            required
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
                        <input type="hidden" name="post_id" value="{{ $house->id }}">
                        <input type="hidden" name="post_type" value="house">
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
        <h1 class="text-3xl font-bold text-slate-900">{{ $house->title }}</h1>
   <p class="text-gray-600 mb-4">
    {{ $house->subcity_en 
        ?? $house->subcity_am 
        ?? 'Unknown area' }}
    {{ $house->region ? ', '.$house->region : '' }}
</p>

        <div class="flex items-center flex-wrap gap-3 mb-6">
            <span class="text-2xl font-bold text-gray-900">ETB {{ number_format($house->price) }}</span>
            <span class="px-3 py-1 bg-cyan-100 text-cyan-800 rounded-full text-sm font-medium">
              {{ $house->purpose == 'for_sale' ? 'For Sale' : 'For Rent' }}
            </span>
        </div>

        <p class="text-gray-700 leading-relaxed mb-8">{{ $house->description }}</p>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-10">
            @php
                $stats = [
                    'Bedrooms' => $house->bedrooms,
                    'Bathrooms' => $house->bathrooms,
                    'Area' => $house->area_m2.' m²',
                    'Garage' => $house->garage ? 'Yes' : 'No',
                    'Floors' => $house->floors,
                    'Built Year' => $house->built_year
                ];
            @endphp

            @foreach($stats as $label => $value)
                <div class="bg-gray-50 p-4 rounded-lg text-center border border-gray-200">
                    <p class="text-gray-500 text-sm">{{ $label }}</p>
                    <p class="text-lg font-semibold text-slate-800">{{ $value }}</p>
                </div>
            @endforeach
        </div>

        <!-- Amenities -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4 text-slate-900">Amenities</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @foreach(($house->amenities ?? []) as $amenity)
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-800">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-700">{{ $amenity }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Map -->
        <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-10">
            <h2 class="text-xl font-semibold mb-4 text-slate-900">Location</h2>

            @if($house->latitude && $house->longitude)
                <iframe
                    src="https://www.google.com/maps?q={{ $house->latitude }},{{ $house->longitude }}&z=15&output=embed"
                    class="w-full h-72 md:h-80 rounded-xl border-0"
                    loading="lazy">
                </iframe>
            @else
                <iframe
                    src="https://www.google.com/maps?q={{ urlencode(($house->city_en ?? $house->city).' '.($house->subcity_en ?? $house->subcity)) }}&output=embed"
                    class="w-full h-72 md:h-80 rounded-xl border-0"
                    loading="lazy">
                </iframe>
            @endif
        </div>
    </div>

<!-- Similar Properties -->
<div class="mt-8">
    <h2 class="text-2xl font-semibold text-slate-900 mb-6">Similar Properties</h2>
    <div class="grid md:grid-cols-4 gap-4">
        @php
        use App\Models\House;

        // 1. Highest priority: same property type
        $similarHouses = House::where('id', '!=', $house->id)
            ->where('property_type', $house->property_type)
            ->latest()
            ->take(8)
            ->get();

        // 2. If less than 8, fill with similar location/price/bedroom/etc.
        if ($similarHouses->count() < 8) {
            $needed = 8 - $similarHouses->count();
            $extraHouses = House::where('id','!=',$house->id)
                ->whereNotIn('id', $similarHouses->pluck('id'))
                ->where(function($q) use ($house) {
                    $q->where('subcity_en', $house->subcity_en)
                      ->orWhere('region', $house->region)
                      ->orWhereBetween('price', [$house->price * 0.85, $house->price * 1.15])
                      ->orWhere('bedrooms', $house->bedrooms)
                      ->orWhere('bathrooms', $house->bathrooms)
                      ->orWhere('garage', $house->garage)
                      ->orWhereBetween('area_m2', [$house->area_m2*0.8, $house->area_m2*1.2]);
                })
                ->latest()
                ->take($needed)
                ->get();

            $similarHouses = $similarHouses->merge($extraHouses);
        }
        @endphp

        @foreach($similarHouses as $sim)
            @php
                $simImg = 'https://placehold.co/1200x800?text=Property';
                if (!empty($sim->images) && isset($sim->images[0])) {
                    $p = ltrim($sim->images[0], '/');
                    if (preg_match('/^https?:\/\//i', $p)) {
                        $simImg = $p;
                    } elseif (Storage::disk('public')->exists($p)) {
                        $simImg = asset('storage/' . $p);
                    }
                }
            @endphp

            <a href="{{ route('houses.show', $sim->id) }}"
               class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition block">
                <img src="{{ $simImg }}" class="w-full h-56 object-cover">
                <div class="p-2">
                    <h3 class="font-semibold text-slate-900 text-sm">{{ $sim->title }}</h3>
                    <p class="text-gray-600">{{ $sim->subcity ?? $sim->city }}</p>
                    <p class="font-bold text-slate-900">ETB {{ number_format($sim->price) }}</p>
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

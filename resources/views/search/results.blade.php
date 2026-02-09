@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-10">

    <h2 class="text-2xl font-bold mb-8">
        Search results for
        <span class="text-slate-700">“{{ $q }}”</span>
    </h2>

    {{-- ===================== CARS ===================== --}}
    @if ($cars->count())
        <h3 class="text-xl font-semibold mb-4">Cars</h3>

        <div class="grid md:grid-cols-3 gap-6 mb-12">
            @foreach ($cars as $car)
                <a href="{{ route('user.cars.show', $car->id) }}" class="car-card block">

                    <div class="relative">
                        <div class="image-container">
                            <img 
    src="{{ $car->images && count($car->images) ? asset('storage/' . $car->images[0]) : asset('storage/placeholder.jpg') }}" 
    alt="{{ $car->title }}"
    class="car-image"
/>
                        </div>

                        <div class="seller-badge">{{ $car->seller_type }}</div>

                        @if ($car->images && count($car->images) > 1)
                            <div class="more-images-badge">
                                +{{ count($car->images) - 1 }}
                            </div>
                        @endif
                    </div>

                    <div class="car-info">
                        <div>
                            <p class="car-price">
                                ETB {{ number_format($car->price) }}
                                <span class="car-price-type">
                                    ({{ $car->price_type }})
                                </span>
                            </p>

                            <p class="car-title-extra">
                                {{ $car->title }}
                            </p>
                        </div>

                        <div class="car-meta">
                            <div class="car-meta-item"><i>🏷️</i> {{ $car->brand }}</div>
                            <div class="car-meta-item"><i>🚗</i> {{ $car->model }}</div>
                            <div class="car-meta-item"><i>📅</i> {{ $car->year }}</div>
                            <div class="car-meta-item"><i>⚙️</i> {{ $car->transmission }}</div>
                            <div class="car-meta-item"><i>🚙</i> {{ $car->body_type }}</div>
                            <div class="car-meta-item"><i>⛽</i> {{ $car->fuel }}</div>
                            <div class="car-meta-item"><i>🔧</i> {{ $car->engine_size }}</div>
                            <div class="car-meta-item"><i>🔄</i> {{ $car->condition }}</div>
                            <div class="car-meta-item"><i>🚗</i> {{ $car->drive_type }}</div>
                            <div class="car-meta-item">
                                <i>📏</i>
                                {{ $car->mileage ? number_format($car->mileage).' km' : 'N/A' }}
                            </div>
                            <div class="car-meta-item"><i>💺</i> {{ $car->seats ?? 'N/A' }}</div>
                            <div class="car-meta-item"><i>🚪</i> {{ $car->doors ?? 'N/A' }}</div>
                        </div>

                        <div class="time-ago">
                            {{ $car->created_at->diffForHumans() }}
                        </div>
                    </div>

                </a>
            @endforeach
        </div>
    @endif

{{-- ===================== HOUSES ===================== --}}
@if ($houses->count())
    <h3 class="text-xl font-semibold mb-4">Houses</h3>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($houses as $house)
@php
    // Ensure it's an array, no json_decode needed
    $houseImages = is_array($house->images) ? $house->images : json_decode($house->images) ?? [];
@endphp


            <a href="{{ route('houses.show', $house->id) }}" class="car-card block">

                <div class="relative">
                    <div class="image-container">
                        <img 
                            src="{{ count($houseImages) ? asset('storage/' . $houseImages[0]) : asset('storage/placeholder.jpg') }}"
                            alt="{{ $house->title }}"
                            class="car-image"
                        >
                    </div>

                    @if ($houseImages && count($houseImages) > 1)
                        <div class="more-images-badge">
                            +{{ count($houseImages) - 1 }}
                        </div>
                    @endif
                </div>

                <div class="car-info">
                    <div>
                        <p class="car-price">
                            ETB {{ number_format($house->price) }}
                            <span class="car-price-type">
                                ({{ $house->purpose ?? 'Sale' }})
                            </span>
                        </p>

                        <p class="car-title-extra">
                            {{ $house->title }}
                        </p>
                    </div>

                    <div class="car-meta">
                        <div class="car-meta-item"><i>📍</i> {{ $house->region }}</div>
                        <div class="car-meta-item"><i>🏙️</i> {{ $house->city_en }}</div>
                        <div class="car-meta-item"><i>🏘️</i> {{ $house->subcity_en ?? 'N/A' }}</div>
                        <div class="car-meta-item"><i>🛏️</i> {{ $house->bedrooms ?? 'N/A' }}</div>
                        <div class="car-meta-item"><i>🛁</i> {{ $house->bathrooms ?? 'N/A' }}</div>
                        <div class="car-meta-item"><i>📐</i> {{ $house->area_m2 ?? 'N/A' }} m²</div>
                        <div class="car-meta-item"><i>🚗</i> {{ $house->parking ?? 'N/A' }}</div>
                        <div class="car-meta-item"><i>🏢</i> {{ $house->property_type ?? 'N/A' }}</div>
                    </div>

                    <div class="time-ago">
                        {{ $house->created_at->diffForHumans() }}
                    </div>
                </div>

            </a>
        @endforeach
    </div>
@endif

    {{-- ===================== EMPTY ===================== --}}
    @if (!$cars->count() && !$houses->count())
        <p class="text-gray-500 mt-12 text-center">
            No results found.
        </p>
    @endif

</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-7xl p-8">
    <h2 class="text-3xl font-semibold text-green-700 mb-6 flex items-center gap-2">
        <i class="zmdi zmdi-check-circle text-green-600"></i> Approved Cars
    </h2>

    @if($cars->count() > 0)
        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
            <table class="min-w-full border-collapse">
                <thead class="bg-green-600 text-white text-sm uppercase">
                    <tr>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Title</th>
                        <th class="py-3 px-4 text-left">Brand</th>
                        <th class="py-3 px-4 text-left">Year</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-center">Status</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach($cars as $car)
@php
    $images = [];

    if (!empty($car->images)) {
        if (is_array($car->images)) {
            $images = $car->images;
        } else {
            $decoded = json_decode($car->images, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $images = $decoded;
            } else {
                $images = explode(',', $car->images);
            }
        }
    }

    $imageUrl = !empty($images[0]) ? asset('storage/' . $images[0]) : 'https://via.placeholder.com/100x70?text=No+Image';
@endphp


                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">
                                <img src="{{ $imageUrl }}" alt="Car" class="w-20 h-14 object-cover rounded-md border">
                            </td>
                            <td class="py-2 px-4 font-medium">{{ $car->title }}</td>
                            <td class="py-2 px-4">{{ $car->brand }}</td>
                            <td class="py-2 px-4">{{ $car->year }}</td>
                            <td class="py-2 px-4 font-semibold">${{ number_format($car->price, 2) }}</td>
                            <td class="py-2 px-4 text-center">
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Approved</span>
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('admin.cars.show', $car->id) }}" class="text-blue-600 hover:underline font-medium">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-5">
            {{ $cars->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center mt-10 text-lg">No approved cars found.</p>
    @endif
</div>
@endsection

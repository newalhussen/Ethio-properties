@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-red-700 mb-6 text-center">Rejected Cars</h1>

    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full border-collapse">
            <thead class="bg-red-600 text-white text-sm uppercase">
                <tr>
                    <th class="py-3 px-4 text-left">Image</th>
                    <th class="py-3 px-4 text-left">Title</th>
                    <th class="py-3 px-4 text-left">Brand</th>
                    <th class="py-3 px-4 text-left">Year</th>
                    <th class="py-3 px-4 text-left">Price</th>
                    <th class="py-3 px-4 text-left">Rejection Reason</th>
                    <th class="py-3 px-4 text-center">Status</th>
                    <th class="py-3 px-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="text-sm">
                @forelse($cars as $car)
                    @php
                        // handle images safely (string JSON/CSV or array)
                        $images = [];
                        if (!empty($car->images)) {
                            if (is_string($car->images)) {
                                $decoded = json_decode($car->images, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                    $images = $decoded;
                                } else {
                                    $images = array_filter(array_map('trim', explode(',', $car->images)));
                                }
                            } elseif (is_array($car->images)) {
                                $images = $car->images;
                            }
                        }
                        $imageUrl = !empty($images[0]) ? asset('storage/' . ltrim($images[0], '/')) : 'https://via.placeholder.com/100x70?text=No+Image';
                    @endphp

                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4">
                            <img src="{{ $imageUrl }}" alt="Car" class="w-20 h-14 object-cover rounded-md border">
                        </td>

                        <td class="py-2 px-4 font-medium">{{ $car->title ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $car->brand ?? 'N/A' }}</td>
                        <td class="py-2 px-4">{{ $car->year ?? 'N/A' }}</td>
                        <td class="py-2 px-4">${{ number_format($car->price ?? 0, 2) }}</td>

                        <td class="py-2 px-4 text-sm text-gray-700">
                            {{ $car->rejection_reason ? \Illuminate\Support\Str::limit($car->rejection_reason, 120) : 'N/A' }}
                        </td>

                        <td class="py-2 px-4 text-center">
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ ucfirst($car->status ?? 'rejected') }}
                            </span>
                        </td>

                        <td class="py-2 px-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                {{-- View --}}
                                <a href="{{ route('admin.cars.show', $car->id) }}" class="inline-block px-3 py-1 text-sm text-blue-600 hover:underline">
                                    View
                                </a>

                                {{-- Re-approve form (POST to approve route) --}}
                                <form action="{{ route('admin.cars.approve', $car->id) }}" method="POST" class="inline-block reapprove-form">
                                    @csrf
                                    <button type="button" class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700 reapprove-btn">
                                        Re-approve
                                    </button>
                                </form>

                                {{-- Delete form --}}
                                <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline-block delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700 delete-btn">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-500">No rejected cars found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $cars->links() }}
    </div>
</div>

{{-- Simple JS for confirmations (paste this at bottom of the same blade) --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Delete confirmation
    document.querySelectorAll('.delete-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Are you sure you want to permanently delete this car?')) {
                this.closest('form').submit();
            }
        });
    });

    // Re-approve confirmation (POST)
    document.querySelectorAll('.reapprove-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (confirm('Re-approve this car? This will set status to "approved".')) {
                // submit the form (closest form)
                this.closest('form').submit();
            }
        });
    });
});
</script>
@endsection

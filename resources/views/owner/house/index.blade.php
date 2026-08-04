@extends('layouts.owner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 transition-colors duration-300">

    <div class="container mx-auto px-4 py-8">

        <!-- Success message -->
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                <p class="text-green-600 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Status Filter Buttons -->
        <div class="flex gap-3 mb-6">
            <button class="status-btn active px-3 py-1 rounded text-xs font-medium" data-status="approved">Approved</button>
            <button class="status-btn px-3 py-1 rounded text-xs font-medium" data-status="pending">Pending</button>
            <button class="status-btn px-3 py-1 rounded text-xs font-medium" data-status="rejected">Rejected</button>
        </div>

        <div id="listingContainer" class="space-y-4">

            @foreach($houses as $house)
                @php
                    $priceFormatted = 'ETB ' . number_format($house->price ?? 0);
                @endphp

                <div class="house-card bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 flex overflow-hidden w-full h-40"
                     data-status="{{ $house->status }}">

                    <!-- Left Image -->
                    <div class="relative w-48 flex-shrink-0">
                        @if($house->images && count($house->images) > 0)
                            <img src="{{ asset('storage/' . $house->images[0]) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Right Info -->
                    <div class="flex-1 p-3 flex flex-col justify-between">

                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-200 mb-1 truncate">
                                {{ $house->title }}
                            </h3>

                            <p class="text-gray-500 text-xs mb-1">
                                {{ $house->region }} • {{ $house->subcity_en ?? '—' }}
                            </p>

                            <p class="text-xs font-bold text-gray-900 dark:text-gray-200">
                                {{ $priceFormatted }}
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-2 flex gap-2 text-[10px]">
                            <a href="{{ route('owner.houses.edit', $house->id) }}"
                               class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded">Edit</a>

                            <form action="{{ route('owner.houses.delete', $house->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-0.5 bg-red-100 text-red-700 rounded">Delete</button>
                            </form>
                        </div>

                    </div>

                </div>
            @endforeach

        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".status-btn");
    const cards = document.querySelectorAll(".house-card");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {

            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            const status = btn.dataset.status;

            cards.forEach(card => {
                const s = card.dataset.status;

                card.style.display = (status === s) ? "flex" : "none";
            });
        });
    });
});

</script>

<style>
.status-btn.active {
    background: linear-gradient(135deg,#8B5CF6 0%,#3B82F6 100%);
    color: white;
}
.status-btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection

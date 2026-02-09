@extends('layouts.owner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 transition-colors duration-300">
    <div class="container mx-auto px-4 py-8">

        <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6">Recycle Bin</h2>

        @forelse($items as $item)
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-2 flex justify-between">
                
                <div class="flex gap-3">
                    {{-- Handle Images --}}
                    @php
                        $img = null;

                        if ($item->type === 'house') {
                            $img = is_array($item->images) ? ($item->images[0] ?? null) : null;
                        } elseif ($item->type === 'car') {
                            $img = is_array($item->images) ? ($item->images[0] ?? null) : null;
                        }
                    @endphp

                    @if($img)
                        <img src="{{ asset('storage/' . $img) }}" class="w-16 h-16 rounded object-cover">
                    @endif

                    <div>
                        {{-- Title --}}
                        <p class="font-semibold">
                            @if($item->type === 'house')
                                {{ $item->title ?? 'Untitled House' }}
                            @else
                                {{ $item->title_en ?? $item->title ?? 'Untitled Car' }}
                            @endif
                        </p>

                        {{-- Price --}}
                        <p class="text-sm text-gray-500">
                            {{ $item->price ? '$' . number_format($item->price) : 'No price' }}
                        </p>

                        {{-- Deleted time --}}
                        <p class="text-xs text-gray-400 mt-1">
                            Deleted {{ $item->deleted_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-2">

                    {{-- Restore --}}
                    @if($item->type === 'house')
                        <form action="{{ route('owner.recycleBin.house.restore', $item->id) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1 bg-green-500 text-white text-sm rounded">Restore</button>
                        </form>
                    @else
                        <form action="{{ route('owner.recycleBin.car.restore', $item->id) }}" method="POST">
                            @csrf
                            <button class="px-3 py-1 bg-green-500 text-white text-sm rounded">Restore</button>
                        </form>
                    @endif

                    {{-- Force Delete --}}
                    @if($item->type === 'house')
                        <form action="{{ route('owner.recycleBin.house.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Permanently delete this house?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded">Delete Permanently</button>
                        </form>
                    @else
                        <form action="{{ route('owner.recycleBin.car.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Permanently delete this car?');">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white text-sm rounded">Delete Permanently</button>
                        </form>
                    @endif

                </div>
            </div>
        @empty
            <p class="text-gray-500">Recycle Bin is empty.</p>
        @endforelse

    </div>
</div>
@endsection

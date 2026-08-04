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
        <!-- Category Filter -->
        <div class="flex flex-col sm:flex-row justify-between items-end sm:items-center mb-4 gap-4">
            <div class="flex gap-3">
                <button id="filterAll" class="filter-btn active px-3 py-1 rounded text-xs font-medium transition-all duration-200">All Posts</button>
                <button id="filterCars" class="filter-btn px-3 py-1 rounded text-xs font-medium transition-all duration-200">Cars</button>
                <button id="filterHouses" class="filter-btn px-3 py-1 rounded text-xs font-medium transition-all duration-200">Houses</button>
            </div>
        </div>

        <div id="listingContainer" class="space-y-4">
            @php
                $allListings = $cars->merge($houses)->sortByDesc('created_at');
            @endphp

            @forelse($allListings as $item)
                @php
                    $type = $item instanceof \App\Models\Car ? 'car' : 'house';
                    $priceFormatted = 'ETB ' . number_format($item->price ?? 0);
                @endphp
           <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 flex overflow-hidden w-full h-40 relative" data-type="{{ $type }}">

           <!-- Status Ribbon -->
@if(isset($item->status))
    <div class="status-ribbon status-{{ strtolower($item->status) }}">
        {{ ucfirst($item->status) }}
    </div>
@endif    
                <!-- Left Image -->
                    <div class="relative w-48 flex-shrink-0">
                        @if(isset($item->images) && count($item->images) > 0)
                            <img src="{{ asset('storage/' . $item->images[0]) }}" class="w-full h-full object-cover" alt="{{ $item->title ?? ($item->brand . ' ' . $item->model) }}">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                No Image
                            </div>
                        @endif
                    </div>

                    <!-- Right Main Info -->
                    <div class="flex-1 p-3 flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-200 mb-1 truncate">
                                {{ $item->title ?? ($item->brand . ' ' . $item->model) }}
                            </h3>
                            <p class="text-gray-500 dark:text-gray-400 mb-1 text-xs truncate">
                                @if(isset($item->year)){{ $item->year }} • @endif
                                @if(isset($item->transmission)){{ $item->transmission }} • @endif
                                {{ $item->location ?? '' }}
                            </p>
                            <p class="text-xs font-bold text-gray-900 dark:text-gray-200 truncate">
                                {{ $priceFormatted }}
                            </p>
                        </div>

                        <!-- Bottom Actions -->
                        <div class="mt-2 flex gap-2 text-[10px]">
                            <a href="{{ $item instanceof \App\Models\Car ? route('owner.cars.edit', $item->id) : route('owner.houses.edit', $item->id) }}"
                               class="px-2 py-0.5 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Edit</a>

                            <form action="{{ $item instanceof \App\Models\Car ? route('owner.delete', $item->id) : route('owner.houses.delete', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-0.5 bg-red-100 text-red-700 rounded hover:bg-red-200">Delete</button>
                            </form>

                            @if(isset($item->status) && $item->status != 'sold')

                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center">No listings yet.</p>
            @endforelse
        </div>
    </div>
</div>

<!-- Filter JS -->
<!-- Scripts -->
<script>
lucide.createIcons();

// Sidebar dropdowns
function toggleDropdown(id) {
    const dropdown = document.getElementById(`dropdown-${id}`);
    dropdown.classList.toggle('hidden');
}

// Desktop notifications
const notifBtn = document.getElementById('notif-btn');
const notifMenu = document.getElementById('notif-menu');
notifBtn?.addEventListener('click', () => notifMenu.classList.toggle('hidden'));
window.addEventListener('click', (e) => {
    if (!notifBtn.contains(e.target) && !notifMenu.contains(e.target)) notifMenu.classList.add('hidden');
});

// Mobile settings dropdown
const mobileToggle = document.getElementById('mobile-settings-toggle');
const mobileMenu = document.getElementById('mobile-settings-menu');
mobileToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

// Mobile sidebar toggle
const hamburgerBtn = document.getElementById('hamburger-btn');
const sidebar = document.getElementById('leftsidebar');
const mainContent = document.getElementById('main-content');

hamburgerBtn.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    mainContent.classList.toggle('ml-0');  // take full width when sidebar is hidden
});

// Theme toggle (desktop + mobile)
const htmlEl = document.documentElement;
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark') htmlEl.classList.add('dark');

const toggleBtns = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile');
const sunIcons = document.querySelectorAll('#sun-icon, #sun-icon-mobile');
const moonIcons = document.querySelectorAll('#moon-icon, #moon-icon-mobile');
const themeTextMobile = document.getElementById('theme-text-mobile');

function updateThemeIcons() {
    const isDark = htmlEl.classList.contains('dark');
    sunIcons.forEach(el => el.classList.toggle('hidden', !isDark));
    moonIcons.forEach(el => el.classList.toggle('hidden', isDark));
    if (themeTextMobile) themeTextMobile.textContent = isDark ? 'Light Mode' : 'Dark Mode';
}
updateThemeIcons();

toggleBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        htmlEl.classList.toggle('dark');
        localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
        updateThemeIcons();
    });
});

// === Category Filter ===
document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");
    const listings = document.querySelectorAll("#listingContainer > div[data-type]");

    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            // Remove 'active' from all buttons
            filterButtons.forEach(btn => btn.classList.remove("active"));
            // Add 'active' to clicked button
            button.classList.add("active");

            const filterType = button.id.replace("filter", "").toLowerCase(); // all, cars, houses

            listings.forEach(listing => {
                const itemType = listing.getAttribute("data-type");
                if (filterType === "all" || itemType === filterType.slice(0, -1)) {
                    listing.style.display = "flex";
                } else {
                    listing.style.display = "none";
                }
            });
        });
    });
});

</script>
<style>
.filter-btn.active { background: linear-gradient(135deg,#8B5CF6 0%,#3B82F6 100%); color: white;}
.filter-btn:hover { transform: translateY(-1px);}
.status-ribbon {
    position: absolute;
    top: 10px;
    right: -40px;
    width: 150px;
    text-align: center;
    transform: rotate(45deg);
    padding: 4px 0;
    font-size: 10px;
    font-weight: bold;
    color: white;
    z-index: 20;
}

/* Colors per status */
.status-approved {
    background: #22c55e; /* green */
}
.status-pending {
    background: #f59e0b; /* amber */
}
.status-rejected {
    background: #ef4444; /* red */
}
</style>
@endsection

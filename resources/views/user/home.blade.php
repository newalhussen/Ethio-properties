@extends('layouts.app')

@section('title', 'Ethio Property - Buy, Sell & Rent Houses and Cars in Ethiopia')
@section('meta_description', 'Ethiopia\'s marketplace for houses and cars. Browse thousands of listings for sale or rent, or post your own free.')

@section('content')
<style>
  /* ======= GLOBAL ======= */
  .text-primary { color: #440057; }
  .bg-primary { background-color: #440057; }
  .btn-primary {
    background-color: #440057;
    color: white;
    font-weight: 600;
    border-radius: 9999px;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s;
  }
  .btn-primary:hover { background-color: #5d0077; }

  .btn-outline {
    border: 2px solid #440057;
    color: #440057;
    font-weight: 600;
    border-radius: 9999px;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s;
  }
  .btn-outline:hover {
    background-color: #440057;
    color: white;
  }

  /* ======= HERO SECTION ======= */
  .hero {
    background: white;
    padding: 5rem 1rem 6rem 1rem;
    position: relative;
    overflow: hidden;
  }

  .hero::before {
    content: "";
    position: absolute;
    width: 900px;
    height: 900px;
    background: radial-gradient(circle at top left, #44005710 0%, transparent 70%);
    top: -300px;
    left: -300px;
    z-index: 0;
  }

  .hero-content {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 3rem;
  }

  .hero-visuals {
    position: relative;
    display: flex;
    justify-content: center;
  }

  .hero-card {
    width: 300px;
    height: 200px;
    background: #fff;
    box-shadow: 0 15px 40px rgba(68, 0, 87, 0.15);
    border-radius: 20px;
    padding: 1rem;
    transform: rotate(-3deg);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .hero-card img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 12px;
  }

  .hero-card h4 {
    margin-top: 0.75rem;
    color: #440057;
    font-weight: 700;
    font-size: 1rem;
  }

  .hero-circle {
    position: absolute;
    width: 220px;
    height: 220px;
    background: radial-gradient(circle at center, #44005715 0%, transparent 70%);
    border-radius: 50%;
    bottom: -40px;
    right: -60px;
    z-index: -1;
  }

  /* ======= FILTER SECTION ======= */
  .filter-section {
    background: #f9fafb;
    padding: 2rem 1rem;
    text-align: center;
  }

  .filter-buttons {
    display: inline-flex;
    background: white;
    border-radius: 9999px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(68, 0, 87, 0.1);
  }

  .filter-buttons button {
    padding: 0.75rem 2rem;
    border: none;
    cursor: pointer;
    background: none;
    font-weight: 600;
    color: #440057;
    transition: 0.3s;
  }

  .filter-buttons button.active {
    background-color: #440057;
    color: white;
  }

  .filter-buttons button:hover {
    background-color: #44005720;
  }

  /* ======= FEATURED SECTION ======= */
  .featured {
    background: #f9fafb;
    padding: 4rem 1rem;
    text-align: center;
  }

  .featured-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
  }

  .featured-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 30px rgba(68, 0, 87, 0.1);
    overflow: hidden;
    transition: 0.3s;
  }

  .featured-card:hover {
    transform: translateY(-5px);
  }

  .featured-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
  }

  .featured-card h3 {
    color: #440057;
    font-weight: 700;
    font-size: 1.25rem;
    margin-top: 1rem;
  }

  .featured-card p {
    color: #555;
    font-size: 0.95rem;
  }
</style>

<!-- Mobile menu + search -->
<div class="block md:hidden p-4 bg-white shadow-md flex flex-col gap-2">

  <!-- Search bar (always visible) -->
  <form action="{{ route('search.index') }}" method="GET" x-data="heroSearch()" class="relative w-full">
    <input
      type="text"
      name="q"
      x-model="q"
      @input.debounce.300ms="fetchSuggestions"
      placeholder="Search houses or cars..."
      class="w-full px-6 py-4 rounded-full border border-gray-300 bg-white/90 backdrop-blur shadow-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 text-lg"
    >

    <!-- Suggestions -->
    <div x-show="results.length" class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl overflow-hidden z-50">
      <template x-for="item in results" :key="item.url">
        <a :href="item.url" class="block px-5 py-3 hover:bg-slate-100 text-sm">
          <span class="font-semibold" x-text="item.title"></span>
          <span class="ml-2 text-xs text-gray-500" x-text="item.type"></span>
        </a>
      </template>
    </div>
  </form>
  
</div>


<!-- ======= HERO SECTION — PREMIUM ABSTRACT 3D WITH MOVING CAR (DESKTOP ONLY) ======= -->
<section class="hidden md:block relative overflow-hidden bg-white py-20 px-0 mx-2">

  <!-- Background radial glow (desktop only) -->
  <div class="absolute top-0 right-0 w-[700px] h-[700px] bg-gradient-to-br from-slate-900/20 via-slate-800/10 to-transparent blur-3xl opacity-70 pointer-events-none"></div>

 <div class="w-full relative z-10 px-6 md:px-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

    <!-- LEFT SIDE: TEXT + BUTTONS (on top of car) -->
    <div class="relative z-10">
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-gray-900 mb-4">
        Find Your <span class="bg-gradient-to-r from-slate-700 to-cyan-400 bg-clip-text text-transparent">Perfect Property</span> Instantly
      </h1>

      <p class="text-gray-600 text-lg mb-8">
        Explore houses and vehicles with a modern, intelligent interface built for high-end users.
      </p>

<form action="{{ route('search.index') }}" method="GET"
      x-data="heroSearch()"
      class="relative max-w-xl">

  <input
    type="text"
    name="q"
    x-model="q"
    @input.debounce.300ms="fetchSuggestions"
    placeholder="Search houses or cars..."
    class="w-full px-6 py-4 rounded-full border border-gray-300 bg-white/90 backdrop-blur shadow-lg focus:outline-none focus:ring-2 focus:ring-cyan-400 text-lg">

  <!-- Suggestions -->
  <div x-show="results.length"
       class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl overflow-hidden z-50">

    <template x-for="item in results" :key="item.url">
      <a :href="item.url"
         class="block px-5 py-3 hover:bg-slate-100 text-sm">
        <span class="font-semibold" x-text="item.title"></span>
        <span class="ml-2 text-xs text-gray-500" x-text="item.type"></span>
      </a>
    </template>

  </div>
</form>

    </div>

    <!-- RIGHT SIDE: ABSTRACT VISUAL + CAR (desktop only) -->
    <div class="relative hidden md:flex justify-center items-center w-full h-96">

      <!-- Central abstract shape -->
      <div class="w-72 h-72 md:w-96 md:h-96 rounded-full bg-gradient-to-tr from-slate-800 via-slate-700 to-cyan-400 blur-[40px] opacity-80 animate-pulse-slow"></div>

      <!-- Rotating rings -->
      <div class="absolute w-56 h-56 md:w-72 md:h-72 rounded-full border-4 border-slate-600/40 animate-rotate-slow"></div>
      <div class="absolute w-32 h-32 md:w-40 md:h-40 rounded-full border-2 border-cyan-400/30 animate-rotate-fast"></div>

      <!-- Floating nodes -->
      <span class="absolute w-4 h-4 bg-cyan-400 rounded-full shadow-lg animate-node-1"></span>
      <span class="absolute w-3 h-3 bg-cyan-300 rounded-full shadow-lg animate-node-2"></span>
      <span class="absolute w-5 h-5 bg-cyan-300 rounded-full shadow-lg animate-node-3"></span>

      <!-- Animated connection lines -->
      <svg class="absolute w-full h-full pointer-events-none opacity-40" viewBox="0 0 400 400">
        <circle cx="200" cy="200" r="150" stroke="#00bcd4" stroke-width="1.2" fill="none" class="animate-line-1"/>
        <circle cx="200" cy="200" r="110" stroke="#00acc1" stroke-width="1" fill="none" class="animate-line-2"/>
        <circle cx="200" cy="200" r="80" stroke="#26c6da" stroke-width="0.8" fill="none" class="animate-line-3"/>
      </svg>

<!-- Moving Car -->
<img src="assets/images/car/silhouette.png" alt="Moving Car"
     class="absolute top-1/2 transform -translate-y-1/2 w-90 animate-car-drive z-0">

<!-- House (appears exactly at car stop position) -->
<img src="assets/images/house.png" alt="Magic House"
     class="w-90 animate-house-appear z-0">
    </div>
  </div>


  
        <!-- Sell / Post Button (always visible) -->
    <!-- <a href="{{ Auth::check() ? url('/choose-post') : route('login') }}"
       @unless(Auth::check())
           onclick="event.preventDefault(); window.location.href='{{ route('login') }}?notice=login_required';"
       @endunless
       class="bg-gradient-to-r from-slate-700 to-cyan-600
              text-white px-5 mx-6 py-2 rounded-full font-semibold
              shadow hover:scale-105 transition ml-10">
        Sell Your Property
    </a> -->
    
    </div>
</section>

<!-- ===== ANIMATIONS ===== -->
<style>
  /* Existing animations here... rotateSlow, rotateFast, pulseSlow, nodeMove1-3, dashAnimation1-3 */
  @keyframes rotateSlow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
  @keyframes rotateFast { from { transform: rotate(0deg); } to { transform: rotate(-360deg); } }
  @keyframes pulseSlow { 0%, 100% { transform: scale(1); opacity: .7; } 50% { transform: scale(1.1); opacity: 1; } }

  @keyframes nodeMove1 { 0%,100% { transform: translate(-40px, -80px); } 50% { transform: translate(-50px, -100px); } }
  @keyframes nodeMove2 { 0%,100% { transform: translate(60px, 30px); } 50% { transform: translate(70px, 60px); } }
  @keyframes nodeMove3 { 0%,100% { transform: translate(-10px, 80px); } 50% { transform: translate(-20px, 110px); } }

  @keyframes dashAnimation1 { 0% { stroke-dashoffset: 0; } 100% { stroke-dashoffset: 500; } }
  @keyframes dashAnimation2 { 0% { stroke-dashoffset: 0; } 100% { stroke-dashoffset: -500; } }

  .animate-rotate-slow { animation: rotateSlow 18s linear infinite; }
  .animate-rotate-fast { animation: rotateFast 9s linear infinite; }
  .animate-pulse-slow { animation: pulseSlow 8s ease-in-out infinite; }

  .animate-node-1 { animation: nodeMove1 7s ease-in-out infinite; }
  .animate-node-2 { animation: nodeMove2 9s ease-in-out infinite; }
  .animate-node-3 { animation: nodeMove3 11s ease-in-out infinite; }

  .animate-line-1 { stroke-dasharray: 5 8; animation: dashAnimation1 12s linear infinite; }
  .animate-line-2 { stroke-dasharray: 1 10; animation: dashAnimation2 8s linear infinite; }
  .animate-line-3 { stroke-dasharray: 3 7; animation: dashAnimation1 10s linear infinite; }

/* Car drives from right, stops at center, then fades out */
@keyframes carDriveAndDisappear {
  0% { right: -300px; opacity: 1; }
  55% { right: calc(50% - 180px); opacity: 1; } /* car stops exactly at center */
  65% { opacity: 0; }
  100% { opacity: 0; }
}
.animate-car-drive {
  animation: carDriveAndDisappear 9s ease-in-out infinite;
}

/* House appears at the exact same spot as car */
@keyframes houseAppear {
  0%, 55% { opacity: 0; transform: translate(0, -50%) scale(0.5); }
  65% { opacity: 1; transform: translate(0, -50%) scale(1); }
  100% { opacity: 1; transform: translate(0, -50%) scale(1); }
}
.animate-house-appear {
  animation: houseAppear 9s ease-in-out infinite;
  position: absolute;
  top: 50%;
  right: calc(50% - 180px); /* exactly same as car */
  z-index: 0;
}
</style>

<!-- ======= LISTINGS SECTION ======= -->
<section class="py-6 bg-gray-50">
  <div class="w-full px-4 md:px-6 space-y-8">

    <!-- Popular Cars Row -->
    <div class="relative">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">Popular Cars</h3>
      <!-- Left Arrow -->
      <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 prev">&larr;</button>

      <!-- Scrollable Cards -->
     <div class="flex overflow-x-auto space-x-3 scrollbar-hide">
       @foreach($popularCars as $car)
<a href="{{ route('user.cars.show', $car->id) }}"
   class="flex-shrink-0 w-[20%] min-w-[220px] bg-transparent transition hover:scale-[1.02] cursor-pointer">

    <img
        src="{{ $car->images && count($car->images) ? asset('storage/'.$car->images[0]) : 'https://via.placeholder.com/800x600?text=Car' }}"
        alt="{{ $car->title_en ?? $car->brand.' '.$car->model }}"
        class="w-full h-32 object-cover">

    <div class="mt-2">
        <h4 class="font-semibold text-gray-900 text-sm">
            {{ $car->title_en ?? $car->brand.' '.$car->model }}
        </h4>

        <p class="text-gray-500 text-xs mt-0.5">
            {{ Str::limit($car->description, 60) }}
        </p>

        <span class="text-green-700 font-semibold text-sm mt-0.5 block">
            ETB {{ number_format($car->price) }}
        </span>
    </div>
</a>

        @endforeach
      </div>

      <!-- Right Arrow -->
      <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 next">&rarr;</button>
    </div>

    <!-- Popular Houses Row -->
    <div class="relative">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">Popular Houses</h3>
      <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 prev">&larr;</button>
<div class="flex overflow-x-auto space-x-3 scrollbar-hide">
       @foreach($popularHouses as $house)
<a href="{{ route('houses.show', $house->id) }}"
   class="flex-shrink-0 w-[20%] min-w-[220px] bg-transparent transition hover:scale-[1.02] cursor-pointer">

    <img
        src="{{ $house->images && count($house->images) ? asset('storage/'.$house->images[0]) : 'https://via.placeholder.com/800x600?text=House' }}"
        alt="{{ $house->title }}"
        class="w-full h-32 object-cover">

    <div class="mt-2">
        <h4 class="font-semibold text-gray-900 text-sm">
            {{ $house->title }}
        </h4>

        <p class="text-gray-500 text-xs mt-0.5">
            {{ Str::limit($house->description, 60) }}
        </p>

        <span class="text-green-700 font-semibold text-sm mt-0.5 block">
            ETB {{ number_format($house->price) }}
        </span>
    </div>
</a>
        @endforeach
      </div>
      <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 next">&rarr;</button>
    </div>

    <!-- New Cars Row -->
    <div class="relative">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">New Cars</h3>
      <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 prev">&larr;</button>
      <div class="flex overflow-x-auto space-x-3 scrollbar-hide">
        @foreach($newCars as $car)
<a href="{{ route('user.cars.show', $car->id) }}"
   class="flex-shrink-0 w-[20%] min-w-[220px] bg-transparent transition hover:scale-[1.02] cursor-pointer">

    <img
        src="{{ $car->images && count($car->images) ? asset('storage/'.$car->images[0]) : 'https://via.placeholder.com/800x600?text=Car' }}"
        alt="{{ $car->title_en ?? $car->brand.' '.$car->model }}"
        class="w-full h-32 object-cover">

    <div class="mt-2">
        <h4 class="font-semibold text-gray-900 text-sm">
            {{ $car->title_en ?? $car->brand.' '.$car->model }}
        </h4>

        <p class="text-gray-500 text-xs mt-0.5">
            {{ Str::limit($car->description, 60) }}
        </p>

        <span class="text-green-700 font-semibold text-sm mt-0.5 block">
            ETB {{ number_format($car->price) }}
        </span>
    </div>
</a>
        @endforeach
      </div>
      <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 next">&rarr;</button>
    </div>

    <!-- New Houses Row -->
    <div class="relative">
      <h3 class="text-2xl font-bold text-gray-900 mb-4">New Houses</h3>
      <button class="absolute left-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 prev">&larr;</button>
      <div class="flex overflow-x-auto space-x-3 scrollbar-hide">
        @foreach($newHouses as $house)
<a href="{{ route('houses.show', $house->id) }}"
   class="flex-shrink-0 w-[20%] min-w-[220px] bg-transparent transition hover:scale-[1.02] cursor-pointer">

    <img
        src="{{ $house->images && count($house->images) ? asset('storage/'.$house->images[0]) : 'https://via.placeholder.com/800x600?text=House' }}"
        alt="{{ $house->title }}"
        class="w-full h-32 object-cover">

    <div class="mt-2">
        <h4 class="font-semibold text-gray-900 text-sm">
            {{ $house->title }}
        </h4>

        <p class="text-gray-500 text-xs mt-0.5">
            {{ Str::limit($house->description, 60) }}
        </p>

        <span class="text-green-700 font-semibold text-sm mt-0.5 block">
            ETB {{ number_format($house->price) }}
        </span>
    </div>
</a>
        @endforeach
      </div>
      <button class="absolute right-0 top-1/2 -translate-y-1/2 bg-gray-200 rounded-full p-2 z-10 hover:bg-gray-300 next">&rarr;</button>
    </div>

  </div>
</section>

<!-- ======= HORIZONTAL SCROLLBAR HIDE & ARROW JS ======= -->
<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
document.querySelectorAll('.relative').forEach(row => {
  const container = row.querySelector('div.overflow-x-auto');
  const nextBtn = row.querySelector('.next');
  const prevBtn = row.querySelector('.prev');
  
  // Track expanded rows
  let expandedRows = [];

  nextBtn.addEventListener('click', () => {
    // If horizontal scroll can still move, just scroll
    if (container.scrollLeft + container.clientWidth < container.scrollWidth - 10) {
      container.scrollBy({ left: 240, behavior: 'smooth' });
    } else {
      // Horizontal end reached → expand remaining items into a new row
      const items = Array.from(container.children);
      const visibleCount = Math.floor(container.clientWidth / items[0].offsetWidth);
      const hiddenItems = items.slice(visibleCount * (expandedRows.length + 1));
      if (hiddenItems.length) {
        const newRow = document.createElement('div');
        newRow.className = 'flex overflow-x-auto space-x-3 mt-3 scrollbar-hide';
        hiddenItems.forEach(item => newRow.appendChild(item));
        row.appendChild(newRow);
        expandedRows.push(newRow);
      }
    }
  });

  prevBtn.addEventListener('click', () => {
    if (expandedRows.length) {
      const lastRow = expandedRows.pop();
      // Move items back to original container
      Array.from(lastRow.children).forEach(item => container.appendChild(item));
      lastRow.remove();
      container.scrollTo({ left: 0, behavior: 'smooth' });
    } else {
      container.scrollBy({ left: -300, behavior: 'smooth' });
    }
  });
});
</script>

<script>
  const buttons = document.querySelectorAll('.filter-buttons button');
  const cards = document.querySelectorAll('.featured-card');
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const filter = btn.getAttribute('data-filter');

      cards.forEach(card => {
        const type = card.getAttribute('data-type');
        if (filter === 'all' || filter === type + 's') {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
</script>
<script>
function heroSearch() {
  return {
    q: '',
    results: [],
    fetchSuggestions() {
      if (this.q.length < 2) {
        this.results = [];
        return;
      }

      fetch(`/search/suggest?q=${this.q}`)
        .then(r => r.json())
        .then(data => this.results = data);
    }
  }
}
</script>
@endsection
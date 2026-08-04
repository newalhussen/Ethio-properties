@extends('layouts.app')

@section('title', 'Cars for Sale & Rent in Ethiopia | Ethio Property')
@section('meta_description', 'Browse cars for sale and rent across Ethiopia. Filter by brand, price, and body type to find your next car.')

@section('content')
<div x-data="carPage()" x-init="init()">
  <div class="cars-page">

<style>
/* ===== PAGE BACKGROUND ===== */
.cars-page {
    display: flex;
    gap: 1.25rem;
    padding: 0.75rem 1rem;
    align-items: flex-start;
    background: #f5f6f7; /* matched to houses page */
}

/* ===== SIDEBAR ===== */
.sidebar {
    width: 260px;
    background: #ffffff; /* white surface like houses sidebar */
    padding: 1rem 0.9rem;
    border-radius: 15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.06);
    flex-shrink: 0;
    position: sticky;
    top: 1rem;
    height: fit-content;
    border: 1px solid #e5e7eb; /* sidebar border token from houses */
}

.sidebar-inner {
    max-height: calc(100vh - 120px);
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 0.3rem;
}

.sidebar-inner::-webkit-scrollbar {
    width: 6px;
}
.sidebar-inner::-webkit-scrollbar-thumb {
     background-color: #334155; /* slate-700 */
    border-radius: 10px;
}
.sidebar-inner::-webkit-scrollbar-track {
    background: #e5e7eb;
}

.sidebar h3 {
    font-weight: 700;
    color: #334155; /* slate-700 */
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    font-size: 1rem;
    letter-spacing: 0.5px;
}
.sidebar label {
    font-weight: 600;
    display: block;
    margin: 0.5rem 0 0.25rem;
    color: #0f172a; /* dark heading color */
    font-size: 0.88rem;
}

.sidebar select,
.sidebar input[type="text"],
.sidebar input[type="number"] {
    width: 100%;
    padding: 0.45rem 0.6rem;
    border-radius: 8px;
    border: 1px solid #cbd5e1; /* input border token */
    background: white;
    font-size: 0.9rem;
    transition: border 0.2s;
    margin-bottom: 0.6rem;
}

.sidebar select:focus,
.sidebar input:focus {
    border-color: #334155; /* focus uses primary accent */
    outline: none;
}

.reset-btn {
    background-color: #334155; /* primary accent */
    color: white;
    border: none;
    padding: 0.55rem;
    width: 100%;
    border-radius: 10px;
    margin-top: 0.8rem;
    cursor: pointer;
    font-weight: 600;
}

.reset-btn:hover {
    background-color: #1e293b; /* darker on hover */
}

/* ===== CARS GRID ===== */
.cars-grid {
    flex: 1;
}

.cars-grid header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    gap: 1rem;
}

/* ===== CAR CARD ===== */
.car-card {
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 22px rgba(0,0,0,0.07);
    transition: transform 0.25s, box-shadow 0.25s;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    text-decoration: none;
    color: inherit;
    display: block;
}

.car-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.image-container {
    position: relative;
    width: 100%;
    height: 160px; /* mobile */
    overflow: hidden;
}

@media(min-width:768px) {
    .image-container {
        height: 220px;
    }
}

.car-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s;
    border-radius: 0;
}

.car-card:hover .car-image {
    transform: scale(1.05);
}

/* ===== BADGES ===== */
.seller-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: #334155; /* slate-700 */
    color: white;
    padding: 0.35rem 0.7rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
}

.more-images-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(51,65,85,0.95);
    color: white;
    padding: 0.35rem 0.7rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
}

/* ===== CAR INFO ===== */
.car-info {
    padding: 0.7rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.car-title-extra {
    font-size: 0.8rem;
    color: #000000; /* dark gray */
    font-weight: 700;
    margin-top: 0.1rem;
    line-height: 1;
}

.car-price {
    color: #334155; /* emphasis color */
    font-weight: 700;
    font-size: 0.9rem;
    margin-bottom: 0.25rem;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.car-price-type {
    font-size: 0.95rem;
    color: #334155;
    font-weight: 600;
}

.car-meta {
    font-size: 0.6rem;
    color: #475569; /* secondary text */
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0.2rem 0.8rem;
    margin-top: 0.2rem;
}

/* Mobile only: show first 6 meta items */
@media (max-width: 767px) {
.car-meta .car-meta-item:nth-child(n+7) {
    display: none;
}
}

.car-meta-item {
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.car-meta-item i {
    width: 12px;
    text-align: center;
}

.time-ago {
    font-size: 0.65rem;
    color: #94a3b8; /* lighter gray for meta time */
    margin-top: 0.3rem;
}

/* ===== GRID RESPONSIVE ===== */
.grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* 2 per row on mobile */
    gap: 0.75rem; /* tighter spacing */
}

@media(min-width:768px) {
    .grid { 
        grid-template-columns: repeat(2, 1fr); 
        gap: 1rem;
    }
}

@media(min-width:1024px) {
    .grid { 
        grid-template-columns: repeat(3, 1fr); 
    }
}


@media(min-width:768px) {
    .grid { grid-template-columns: repeat(2, 1fr); }
}

@media(max-width:1024px) {
    .cars-page { flex-direction: column; }

    /* float filters above listings on mobile */
    .sidebar {
        width: 50%;
        position: absolute;
        top: 4.5rem; /* below navbar */
        left: 1rem;
        z-index: 50;
    }

    .sidebar-inner { max-height: 70vh; }
}

/* ===== MOBILE APPLY BAR ===== */
.mobile-apply-bar {
    position: sticky;
    bottom: 0;
    background: white;
    padding: 0.8rem 0.5rem 0.5rem;
    margin-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

.apply-btn {
    width: 100%;
    padding: 0.75rem;
    border-radius: 12px;
    border: none;
    background: #0f172a; /* dark slate */
    color: white;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
}

.apply-btn:hover {
    background: #020617;
}

/* ===== MOBILE FLOATING FILTER PANEL ===== */
@media (max-width: 767px) {
    .sidebar {
        width: 50vw;               /* half screen */
        max-width: 320px;
        height: calc(100vh - 5rem);
        overflow-y: auto;
        box-shadow: 8px 0 25px rgba(0,0,0,0.15);
        border-radius: 0 16px 16px 0;
    }
}
</style>

<div
  :class="{
    'translate-x-0': mobileFilters,
    '-translate-x-full': !mobileFilters
  }"
  class="sidebar fixed left-0 z-40 transition-transform duration-300
         md:static md:translate-x-0 md:block"
  style="top: 8rem;"
>

  <div class="sidebar-inner">
    <h3>{{ __('Filter Cars') }}</h3>

    <!-- Keyword -->
    <label>Keyword</label>
    <input type="text" placeholder="Search..." x-model="filters.q" @input="updateFilters">

    <!-- Make / Brand -->
    <label>Make / Brand</label>
    <select x-model="filters.brand" @change="updateFilters">
      <option value="">All</option>
      <template x-for="make in makes" :key="make">
        <option :value="make" x-text="make"></option>
      </template>
    </select>

    <!-- Model -->
    <label>Model</label>
    <input type="text" placeholder="Model" x-model="filters.model" @input="updateFilters">

        <!-- Sale/Rent Toggle -->
    <label>Sale/Rent</label>
    <select x-model="filters.sale_rent" @change="updateFilters">
      <option value="">All</option>
      <option value="sale">For Sale</option>
      <option value="rent">For Rent</option>
    </select>

    <!-- Body Type -->
    <label>Body Type</label>
    <select x-model="filters.body_type" @change="updateFilters">
      <option value="">All</option>
      <template x-for="type in bodyTypes" :key="type">
        <option :value="type" x-text="type"></option>
      </template>
    </select>

    <!-- Transmission -->
    <label>Transmission</label>
    <select x-model="filters.transmission" @change="updateFilters">
      <option value="">All</option>
      <option value="Automatic">🔄 Automatic</option>
      <option value="Manual">⚙️ Manual</option>
    </select>

    <!-- Fuel Type -->
    <label>Fuel Type</label>
    <select x-model="filters.fuel" @change="updateFilters">
      <option value="">All</option>
      <option value="Petrol">⛽ Petrol</option>
      <option value="Diesel">🚛 Diesel</option>
      <option value="Hybrid">🔋 Hybrid</option>
      <option value="Electric">⚡ Electric</option>
    </select>

    <!-- Year Range -->
    <label>Year Range</label>
    <div class="flex gap-2">
      <input type="number" placeholder="From" x-model.number="filters.year_min" @input="updateFilters" min="1980" max="2024">
      <input type="number" placeholder="To" x-model.number="filters.year_max" @input="updateFilters" min="1980" max="2024">
    </div>

    <!-- Mileage -->
    <label>Max Mileage (km)</label>
    <input type="range" x-model.number="filters.mileage" @input="updateFilters" min="0" max="500000" step="1000" style="width: 100%;">
    <div class="text-sm text-gray-600" style="margin-bottom: 0.6rem;">
      Selected: <span x-text="filters.mileage || 0"></span> km or less
    </div>

    <!-- Engine Size -->
    <label>Engine Size</label>
    <input type="text" placeholder="e.g. 2.0L" x-model="filters.engine_size" @input="updateFilters">

    <!-- Color -->
    <label>Color</label>
    <select x-model="filters.color" @change="updateFilters">
      <option value="">All Colors</option>
      <option value="White">⚪ White</option>
      <option value="Black">⚫ Black</option>
      <option value="Silver">🔘 Silver</option>
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

    <!-- Drive Type -->
    <label>Drive Type</label>
    <select x-model="filters.drive_type" @change="updateFilters">
      <option value="">All</option>
      <option value="FWD">🚗 FWD</option>
      <option value="RWD">🚗 RWD</option>
      <option value="AWD">🚙 AWD</option>
      <option value="4WD">🚙 4WD</option>
      <option value="Other">Other</option>
    </select>

    <!-- Condition -->
    <label>Condition</label>
    <select x-model="filters.condition" @change="updateFilters">
      <option value="">All</option>
      <option value="New">✨ New</option>
      <option value="Used">🔄 Used</option>
      <option value="Foreign Used">🌍 Foreign Used</option>
      <option value="Other">Other</option>
    </select>

    <!-- Seller Type -->
    <label>Seller Type</label>
    <select x-model="filters.seller_type" @change="updateFilters">
<option value="">All</option>
<option value="private">👤 Private</option>
<option value="broker">🏢 Broker</option>
<option value="dealership">🏪 Dealership</option>

    </select>

    <!-- Price Range -->
    <label>Price Range (Birr)</label>
    <div class="flex gap-2">
      <input type="number" placeholder="Min" x-model.number="filters.price_min" @input="updateFilters">
      <input type="number" placeholder="Max" x-model.number="filters.price_max" @input="updateFilters">
    </div>

    <!-- Reset Button -->
    <button class="reset-btn mb-20" @click="resetFilters()">Reset Filters</button>

<!-- Mobile Apply Button -->
<div class="mobile-apply-bar md:hidden">
  <button
    class="apply-btn"
    @click="
      updateFilters();
      mobileFilters = false;
    ">
    Apply Filters
  </button>
</div>
  </div>
</div>

<!-- Main -->
<main class="cars-grid flex-1">
<header class="flex items-center justify-between mb-6 gap-3">

  <!-- Mobile: Filters button (left) -->
  <button
    class="md:hidden flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm"
    @click="mobileFilters = !mobileFilters">
    ☰ Filters
  </button>

  <!-- Sort dropdown (right on mobile, normal on desktop) -->
  <select
    x-model="filters.sort_by"
    @change="updateFilters"
    class="border border-gray-300 rounded-lg px-3 py-2 bg-white shadow-sm ml-auto">
    
    <option value="newest">Newest First</option>
    <option value="oldest">Oldest First</option>
    <option value="price_high">Price High to Low</option>
    <option value="price_low">Price Low to High</option>
    <option value="year_new">Year New to Old</option>
    <option value="year_old">Year Old to New</option>
  </select>

</header>


  <div class="grid">
    <template x-for="car in filteredCars()" :key="car.id">

      <a :href="'/cars/' + car.id" class="car-card block">
        <div class="relative">
          
<div class="image-container">


    <img
        :src="car.images.length > 0 ? car.images[0] : '/storage/placeholder.jpg'"
        :alt="car.title || 'Car'"
        class="car-image"
    >
</div>

          <div class="seller-badge" x-text="car.seller_type"></div>
          <div x-show="car.images.length > 1" class="more-images-badge" x-text="'+' + (car.images.length - 1)"></div>
        </div>

        <div class="car-info">
<div>


  <!-- <h3 class="car-title" x-text="car.brand + ' ' + car.model"></h3> -->

  <!-- Price and type on one line -->
  <p class="car-price">
    <span x-text="'ETB ' + car.price.toLocaleString()"></span>
    <span class="car-price-type" x-text="'(' + car.price_type + ')'"></span>
  </p>

    <!-- Title  -->
  <p class="car-title-extra" x-text="car.title"></p>
</div>


          <div class="car-meta">
            <div class="car-meta-item">
              <i>🏷️</i>
              <span x-text="car.brand"></span>
            </div>
            <div class="car-meta-item">
              <i>🚗</i>
              <span x-text="car.model"></span>
            </div>
            <div class="car-meta-item">
              <i>📅</i>
              <span x-text="car.year"></span>
            </div>
            <div class="car-meta-item">
              <i>⚙️</i>
              <span x-text="car.transmission"></span>
            </div>
            <div class="car-meta-item">
              <i>🚙</i>
              <span x-text="car.body_type"></span>
            </div>
            <div class="car-meta-item">
              <i>⛽</i>
              <span x-text="car.fuel"></span>
            </div>
            <div class="car-meta-item">
              <i>🔧</i>
              <span x-text="car.engine_size"></span>
            </div>
            <div class="car-meta-item">
              <i>🔄</i>
              <span x-text="car.condition"></span>
            </div>
            <div class="car-meta-item">
              <i>🚗</i>
              <span x-text="car.drive_type"></span>
            </div>
            <div class="car-meta-item">
              <i>📏</i>
              <span x-text="car.mileage ? car.mileage.toLocaleString() + ' km' : 'N/A'"></span>
            </div>
            <div class="car-meta-item">
  <i>💺</i>
  <span x-text="car.seats ? car.seats + ' seats' : 'N/A'"></span>
</div>
<div class="car-meta-item">
  <i>🚪</i>
  <span x-text="car.doors ? car.doors + ' doors' : 'N/A'"></span>
</div>

</div>
<!-- <div class="mt-2">
  <span class="text-xl text-[#059669] font-bold" x-text="car.contact_phone || '-'"></span>
</div> -->

<div class="time-ago" x-text="daysAgo(car.created_at)"></div>

        </div>
      </a>
    </template>

    <template x-if="filteredCars().length == 0">
      <p class="col-span-full text-center text-gray-500 mt-10">No cars found matching your criteria.</p>
    </template>
  </div>
</main>
</div>
</div>
<script>
function carPage() {
  return {
    mobileFilters: false,
    makes: ['Toyota','Nissan','Honda','Mazda','Subaru','Mitsubishi','Suzuki','Lexus','BMW','Mercedes-Benz','Audi','Ford','Chevrolet','Kia','Hyundai','Volkswagen','Other'],
    bodyTypes: ['Sedan','SUV','Hatchback','Pickup','Van','Coupe','Convertible','Truck','Bus','Other'],

    filters: {
      q: "",
      sale_rent: "",
      brand: "",
      model: "",
      body_type: "",
      transmission: "",
      fuel: "",
      year_min: "",
      year_max: "",
      mileage: "",
      engine_size: "",
      color: "",
      drive_type: "",
      condition: "",
      seller_type: "",
      price_min: "",
      price_max: "",
      sort_by: "newest"
    },

    cars: @json($carsForJS),

    init() {
      // Set initial sale_rent from URL parameter
      const urlParams = new URLSearchParams(window.location.search);
      this.filters.sale_rent = urlParams.get('sale_rent') || "";
    },

    updateFilters() {
      this.filtered = this.filteredCars();
    },

    resetFilters() {
      this.filters = {
        q: "",
        sale_rent: "",
        brand: "",
        model: "",
        body_type: "",
        transmission: "",
        fuel: "",
        year_min: "",
        year_max: "",
        mileage: "",
        engine_size: "",
        color: "",
        drive_type: "",
        condition: "",
        seller_type: "",
        price_min: "",
        price_max: "",
        sort_by: "newest"
      };
      this.updateFilters();
    },

daysAgo(created_at) {
  if (!created_at) return '';

  const created = new Date(created_at);
  const now = new Date();
  const diffMs = now - created;

  const minute = 60 * 1000;
  const hour   = 60 * minute;
  const day    = 24 * hour;
  const week   = 7 * day;
  const month  = 30 * day;
  const year   = 365 * day;

  if (diffMs < hour) {
    return "Today";
  }
  if (diffMs < day) {
    return "Today";
  }
  if (diffMs < week) {
    const days = Math.floor(diffMs / day);
    return `${days} day${days > 1 ? 's' : ''} ago`;
  }
  if (diffMs < month) {
    const weeks = Math.floor(diffMs / week);
    return `${weeks} week${weeks > 1 ? 's' : ''} ago`;
  }
  if (diffMs < year) {
    const months = Math.floor(diffMs / month);
    return `${months} month${months > 1 ? 's' : ''} ago`;
  }

  const years = Math.floor(diffMs / year);
  return `${years} year${years > 1 ? 's' : ''} ago`;
},

    filteredCars() {
      let filtered = this.cars;

      if (this.filters.q) filtered = filtered.filter(c => 
        c.brand.toLowerCase().includes(this.filters.q.toLowerCase()) ||
        c.model.toLowerCase().includes(this.filters.q.toLowerCase()) ||
        (c.description && c.description.toLowerCase().includes(this.filters.q.toLowerCase()))
      );
      if (this.filters.sale_rent) filtered = filtered.filter(c => c.sale_rent === this.filters.sale_rent);
      if (this.filters.brand) filtered = filtered.filter(c => c.brand === this.filters.brand);
      if (this.filters.model) filtered = filtered.filter(c => c.model.toLowerCase().includes(this.filters.model.toLowerCase()));
      if (this.filters.body_type) filtered = filtered.filter(c => c.body_type === this.filters.body_type);
      if (this.filters.transmission) filtered = filtered.filter(c => c.transmission === this.filters.transmission);
      if (this.filters.fuel) filtered = filtered.filter(c => c.fuel === this.filters.fuel);
      if (this.filters.year_min) filtered = filtered.filter(c => c.year >= this.filters.year_min);
      if (this.filters.year_max) filtered = filtered.filter(c => c.year <= this.filters.year_max);
      if (this.filters.mileage) filtered = filtered.filter(c => c.mileage <= this.filters.mileage);
      if (this.filters.engine_size) filtered = filtered.filter(c => c.engine_size && c.engine_size.toLowerCase().includes(this.filters.engine_size.toLowerCase()));
      if (this.filters.color) filtered = filtered.filter(c => c.color === this.filters.color);
      if (this.filters.drive_type) filtered = filtered.filter(c => c.drive_type === this.filters.drive_type);
      if (this.filters.condition) filtered = filtered.filter(c => c.condition === this.filters.condition);
      if (this.filters.seller_type) filtered = filtered.filter(c => c.seller_type === this.filters.seller_type);
      if (this.filters.price_min) filtered = filtered.filter(c => c.price >= this.filters.price_min);
      if (this.filters.price_max) filtered = filtered.filter(c => c.price <= this.filters.price_max);

      switch (this.filters.sort_by) {
        case "newest": filtered = filtered.sort((a,b) => new Date(b.created_at) - new Date(a.created_at)); break;
        case "oldest": filtered = filtered.sort((a,b) => new Date(a.created_at) - new Date(b.created_at)); break;
        case "price_high": filtered = filtered.sort((a,b) => b.price - a.price); break;
        case "price_low": filtered = filtered.sort((a,b) => a.price - b.price); break;
        case "year_new": filtered = filtered.sort((a,b) => b.year - a.year); break;
        case "year_old": filtered = filtered.sort((a,b) => a.year - b.year); break;
      }

      return filtered;
    }
  }
}
</script>
@endsection
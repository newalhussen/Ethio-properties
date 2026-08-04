@extends('layouts.app')

@section('title', 'Houses for Sale & Rent in Ethiopia | Ethio Property')
@section('meta_description', 'Browse houses for sale and rent across Ethiopia. Filter by location, price, and bedrooms to find your next home.')

@section('content')
<div x-data="housePage()" x-init="init()" class="houses-page cars-page">

<style>
  .cars-page {
      display: flex;
      gap: 1.25rem;
      padding: 0.75rem 1rem;
      align-items: flex-start;
      background: #f5f6f7;
  }
  /* Sidebar */
  .sidebar {
      width: 260px;
      background: #ffffff;
      padding: 1rem 0.9rem;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.06);
      flex-shrink: 0;
      position: sticky;
      top: 1rem;
      height: fit-content;
      border: 1px solid #e5e7eb;
  }
  .sidebar-inner {
      max-height: calc(100vh - 120px);
      overflow-y: auto;
      overflow-x: hidden;
      padding-right: 0.3rem;
  }
  /* Scrollbar */
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
  .sidebar select,
  .sidebar input[type="text"],
  .sidebar input[type="number"] {
      width: 100%;
      padding: 0.45rem 0.6rem;
      border-radius: 8px;
      border: 1px solid #cbd5e1;
      background: white;
      font-size: 0.9rem;
      transition: border 0.2s;
      margin-bottom: 0.6rem;
  }
  .sidebar select:focus,
  .sidebar input:focus {
      border-color: #334155;
      outline: none;
  }
  .reset-btn {
      background-color: #334155; /* slate-700 */
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
      background-color: #1e293b; /* slate-800/900 */
  }

  /* Houses Grid */
  .houses-grid {
      flex: 1;
  }
  .houses-grid header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      gap: 1rem;
  }
  .property-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 8px 22px rgba(0,0,0,0.07);
      transition: transform 0.25s, box-shadow 0.25s;
      background: white;
      border: 1px solid #e2e8f0;
      text-decoration: none;
      color: inherit;
  }
  .property-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
  }
  .property-card img {
      width: 100%;
      height: 240px;
      object-fit: cover;
      transition: transform 0.3s;
  }
  .property-card:hover img {
      transform: scale(1.05);
  }
  .property-info {
      padding: 0.9rem 1rem;
  }
  .property-info h3 {
      font-size: 1.1rem;
      font-weight: 600;
      color: #0f172a;
  }
  .property-info .price {
      color: #334155; /* slate-700 */
      font-weight: 700;
      font-size: 1.15rem;
      margin-bottom: 0.4rem;
  }
  .property-meta {
      font-size: 0.85rem;
      color: #475569;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 0.4rem 0.8rem;
      margin-top: 0.5rem;
  }
  .property-meta .phone {
      color: #334155;
      font-weight: 700;
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .cars-page {
      flex-direction: column;
    }
    .sidebar {
      width: 100%;
      position: relative;
      top: 0;
    }
    .sidebar-inner {
      max-height: 70vh;
    }
    .filter-toggle {
      display: inline-block;
      background: #334155;
      color: white;
      padding: 0.6rem 1.1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      font-weight: 600;
    }
    
  }
  /* Mobile card compacting */
@media (max-width: 640px) {
  .property-info h3 {
    font-size: 0.95rem;
    line-height: 1.2;
    display: -webkit-box;
    -webkit-line-clamp: 2;   /* max 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
  }
}
@media (max-width: 640px) {
  .property-info {
    padding: 0.6rem 0.65rem;
  }
}
@media (max-width: 640px) {
  .property-info .price {
    font-size: 0.95rem;
    margin-bottom: 0.25rem;
  }

  .property-info p {
    font-size: 0.75rem;
    margin-bottom: 0.25rem;
  }
}
@media (max-width: 640px) {
  .property-info .price {
    font-size: 0.95rem;
    margin-bottom: 0.25rem;
  }

  .property-info p {
    font-size: 0.75rem;
    margin-bottom: 0.25rem;
  }
}
@media (max-width: 640px) {
  .property-meta {
    font-size: 0.75rem;
    gap: 0.25rem 0.5rem;
  }
}
@media (max-width: 640px) {
  .property-card img {
    height: 140px; /* was 240px */
  }
}
/* ===== MOBILE FLOATING FILTER PANEL (MATCH CARS) ===== */
@media (max-width: 767px) {
  .sidebar {
    width: 50vw;               /* half screen */
    max-width: 320px;
    height: calc(100vh - 5rem);
    position: fixed;
    left: 0;
    top: 8rem;                 /* below navbar */
    z-index: 40;
    overflow-y: auto;
    box-shadow: 8px 0 25px rgba(0,0,0,0.15);
    border-radius: 0 16px 16px 0;
    transition: transform 0.3s ease;
  }
}
</style>
<!-- Mobile Top Controls -->
<div class="md:hidden w-full flex items-center justify-between mb-1">

  <!-- LEFT -->
  <button
    @click="mobileFilters = !mobileFilters"
    class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg bg-white shadow-sm">
    ☰ Filters
  </button>

  <!-- RIGHT -->
  <select
    x-model="filters.property_type"
    @change="updateFilters"
    class="border border-gray-300 rounded-lg px-3 py-2 bg-white shadow-sm text-sm">
    <option value="All">Property Type</option>
    <option value="Villa">Villa</option>
    <option value="Apartment">Apartment</option>
    <option value="Condominium">Condominium</option>
    <option value="Commercial">Commercial</option>
    <option value="Guest House">Guest House</option>
    <option value="Land / Plot">Land / Plot</option>
  </select>

</div>

<div
  :class="{
    'translate-x-0': mobileFilters,
    '-translate-x-full': !mobileFilters
  }"
  class="sidebar fixed left-0 z-40 transition-transform duration-300
         md:static md:translate-x-0 md:block">
           <div class="sidebar-inner">
    <h3>{{ __('Filter Houses') }}</h3>

    <!-- Inputs -->
    <label>Keyword</label>
    <input type="text" placeholder="Search..." x-model="filters.q" @input="updateFilters">

    <label>Purpose</label>
    <select x-model="filters.purpose" @change="updateFilters">
      <option value="">All</option>
      <option value="for_sale">For Sale</option>
      <option value="for_rent">For Rent</option>
    </select>

    <label>Region</label>
    <select x-model="filters.region" @change="updateLocations(); updateFilters()">
      <option value="">All Regions</option>
      <template x-for="region in Object.keys(regionLocations)" :key="region">
        <option :value="region" x-text="region"></option>
      </template>
    </select>

    <label>Location</label>
    <select x-model="filters.location" @change="updateFilters">
      <option value="">All Locations</option>
      <template x-for="loc in availableLocations" :key="loc">
        <option :value="loc" x-text="loc"></option>
      </template>
    </select>
<label>Price Range (Birr)</label>
<div class="flex gap-2">
  <input type="number" placeholder="Min"
         x-model.number="filters.min_price"
         @input="applyFilters(false)">

  <input type="number" placeholder="Max"
         x-model.number="filters.max_price"
         @input="applyFilters(false)">
</div>

    <label>Area (m²)</label>
    <div class="flex gap-2">
     <input type="number" placeholder="Min"
       x-model.number="filters.min_area"
       @input="applyFilters(false)">

<input type="number" placeholder="Max"
       x-model.number="filters.max_area"
       @input="applyFilters(false)">
    </div>

    <label>Bedrooms</label>
    <select x-model="filters.bedrooms" @change="updateFilters">
      <option value="">Any</option>
      <template x-for="n in 10" :key="n">
        <option :value="n" x-text="n"></option>
      </template>
    </select>

    <label>Bathrooms</label>
    <select x-model="filters.bathrooms" @change="updateFilters">
      <option value="">Any</option>
      <template x-for="n in 10" :key="n">
        <option :value="n" x-text="n"></option>
      </template>
    </select>
    <label>Seller Type</label>
<select x-model="filters.seller_type" @change="updateFilters">
  <option value="">All</option>
  <option value="owner">Property Owner</option>
  <option value="broker">Real Estate Broker</option>
  <option value="dealer">Property Dealer</option>
  <option value="agent">Real Estate Agent</option>
</select>

    <label>Amenities</label>
    <template x-for="amenity in amenities" :key="amenity">
      <div>
        <input type="checkbox" :value="amenity" x-model="filters.amenities" @change="updateFilters">
        <span x-text="amenity"></span>
      </div>
    </template>
    <!-- Mobile Apply Button -->
<div class="md:hidden mt-4">
  <button
    @click="applyFilters(true)"
    class="w-full bg-slate-800 text-white py-2 rounded-lg font-semibold">
    Apply Filters
  </button>
</div>

    <button class="reset-btn" @click="resetFilters()">Reset Filters</button>
  </div>
</div>
<!-- Main -->
<main class="houses-grid flex-1">
  <header class="flex justify-between items-center mb-6 md:mb-6 mb-2">

<!-- Desktop Version -->
<div class="categories hidden md:flex flex-wrap gap-2">
  <template x-for="type in ['All','Villa','Apartment','Condominium','Commercial','Guest House','Land / Plot']" :key="type">
    <button 
      @click="filters.property_type = type; updateFilters()"
      :class="filters.property_type == type 
         ? 'bg-slate-800 text-white' 
         : 'bg-white text-gray-700'"
      class="px-4 py-2 text-sm font-medium rounded-full border border-gray-300 hover:bg-slate-800 hover:text-white transition">
      <span x-text="type"></span>
    </button>
  </template>
</div>
  </header>
  <div class="grid grid-cols-2 gap-3 md:gap-4">
    <template x-for="house in filteredHouses()" :key="house.id">
      <a :href="'/houses/' + house.id" class="property-card block">
        <div class="relative">
          <img :src="house.first_image || '/default-house.jpg'" :alt="house.title || 'House'">

          <span class="absolute top-3 left-3 bg-slate-800 text-white text-xs font-semibold px-3 py-1 rounded-full"
            x-text="house.purpose == 'for_sale' ? 'For Sale' : 'For Rent'"></span>
        </div>
        <div class="property-info">
          <h3 x-text="house.title"></h3>
          <p class="text-sm text-gray-500 mb-2" x-text="house.location || house.region"></p>
          <p class="price" x-text="'ETB ' + house.price.toLocaleString() + (house.purpose == 'for_rent' ? '/month' : '')"></p>

          <div class="property-meta">
            <div>🛏 <span x-text="house.bedrooms || '-'"></span> Beds</div>
            <div>🚿 <span x-text="house.bathrooms || '-'"></span> Baths</div>
            <div class="hidden sm:block">
  📏 <span x-text="house.area_m2 || '-'"></span> m²
</div>
            <!-- <div class="phone">📞 <span x-text="house.contact_phone"></span></div> -->
            <div class="col-span-2 text-gray-400 text-xs hidden sm:block"
     x-text="daysAgo(house.created_at)"></div>
          </div>
        </div>
      </a>
    </template>
    <template x-if="filteredHouses().length == 0">
      <p class="col-span-2 text-center text-gray-500 mt-10">No houses found.</p>
    </template>
  </div>
</main>
</div>
<script>
function housePage() {
  return {
    mobileFilters: false,
    showPropertyTypes: false,
    amenities: {!! json_encode(['Parking','Balcony','Security','Elevator','Water Tank','Generator','Internet','Furnished','Garden','Swimming Pool','Garage','Air Conditioning','Laundry Room']) !!},
    regionLocations: {
      "Addis Ababa": ["Bole","Kazanchis","Lebu","CMC","Ayat","Piassa","Megenagna","Summit"],
      "Adama": ["Wonji","Kebele 03","Kebele 05","Geda"],
      "Bahir Dar": ["Kebele 01","Tana Area","Dagmawi Minilik","Abay Mado"],
      "Bishoftu": ["Hora","Kality","Oda Nebe","Adulala"]
    },
    availableLocations: [],
    filters: {
      q: "",
      purpose: "",
      region: "",
      location: "",
      min_price: "",
      max_price: "",
      bedrooms: "",
      bathrooms: "",
      min_area: "",
      max_area: "",
      seller_type: "",
      amenities: [],
      property_type: "All",
    },
    houses: @json($housesForJS),
    init() {
      this.updateLocations();
    },
    updateLocations() {
      this.availableLocations = this.filters.region ? this.regionLocations[this.filters.region] || [] : [];
      this.filters.location = "";
    },
    applyFilters(closePanel = false) {
  // update results
  this.filtered = this.filteredHouses();

  // close sidebar ONLY when requested (mobile)
  if (closePanel && window.innerWidth < 768) {
    this.mobileFilters = false;
    this.showPropertyTypes = false;
  }
},
updateFilters() {
  this.applyFilters(true);
},
    resetFilters() {
      this.filters = {
        q: "",
        purpose: "",
        region: "",
        location: "",
        min_price: "",
        max_price: "",
        bedrooms: "",
        bathrooms: "",
        min_area: "",
        max_area: "",
        seller_type: "",
        amenities: [],
        property_type: "All",
      };
      this.updateFilters();
    },
    daysAgo(created_at) {
      if (!created_at) return '';
      const created = new Date(created_at);
      const now = new Date();
      const diffDays = Math.floor((now - created) / (1000 * 60 * 60 * 24));
      return diffDays === 0 ? "Today" : `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
    },
    filteredHouses() {
      let filtered = this.houses;
      if (this.filters.q) filtered = filtered.filter(h => h.title.toLowerCase().includes(this.filters.q.toLowerCase()));
      if (this.filters.purpose) filtered = filtered.filter(h => h.purpose === this.filters.purpose);
      if (this.filters.region) {
        filtered = filtered.filter(h => (h.region || '').toLowerCase() === this.filters.region.toLowerCase());
      }
      if (this.filters.location) filtered = filtered.filter(h => (h.location || h.subcity) === this.filters.location);
      if (this.filters.min_price) filtered = filtered.filter(h => h.price >= this.filters.min_price);
      if (this.filters.max_price) filtered = filtered.filter(h => h.price <= this.filters.max_price);
      if (this.filters.min_area) filtered = filtered.filter(h => h.area_m2 >= this.filters.min_area);
      if (this.filters.max_area) filtered = filtered.filter(h => h.area_m2 <= this.filters.max_area);
      if (this.filters.bedrooms) filtered = filtered.filter(h => h.bedrooms == this.filters.bedrooms);
      if (this.filters.bathrooms) filtered = filtered.filter(h => h.bathrooms == this.filters.bathrooms);
      if (this.filters.seller_type) 
    filtered = filtered.filter(h => (h.seller_type || '').toLowerCase() === this.filters.seller_type.toLowerCase());
      if (this.filters.amenities.length > 0) 
    filtered = filtered.filter(h => Array.isArray(h.amenities) && this.filters.amenities.every(a => h.amenities.includes(a)));
      if (this.filters.property_type && this.filters.property_type !== "All") filtered = filtered.filter(h => h.property_type === this.filters.property_type);
      return filtered;
    }
  }
}
</script>
@endsection

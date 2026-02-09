<!DOCTYPE html>
<html lang="en" class="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Owner Dashboard')</title>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
tailwind.config = { darkMode: 'class' }
</script>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition-all duration-300">

<!-- TOP NAVBAR -->
<header class="fixed top-0 left-0 right-0 h-16 bg-white dark:bg-gray-800 border-b dark:border-gray-700 shadow z-50">

<div class="h-full flex justify-between items-center px-6">

<div class="flex items-center gap-4">

<button id="hamburger-btn"
class="sm:hidden w-10 h-10 rounded-full border dark:border-gray-600 flex items-center justify-center">
<i data-lucide="menu"></i>
</button>

<a href="{{ route('owner.dashboard') }}" class="text-xl font-bold">
Ethio Properties
</a>

</div>

<div class="flex items-center gap-3">

<a href="{{ route('choose.post') }}"
class="hidden sm:flex px-3 py-1 bg-indigo-600 text-white rounded text-sm">
Post
</a>

<button id="theme-toggle" class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
<i id="sun-icon" data-lucide="sun" class="hidden w-5 h-5"></i>
<i id="moon-icon" data-lucide="moon" class="w-5 h-5"></i>
</button>

<a href="{{ route('owner.profile') }}">
<img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : '/images/avatar.jpg' }}"
class="w-9 h-9 rounded-full object-cover border">
</a>

<a href="{{ route('user.home') }}"
class="px-3 py-1 rounded text-sm hover:bg-gray-200 dark:hover:bg-gray-700">
Switch to Buyer
</a>

</div>

</div>
</header>

<!-- PAGE -->
<div class="flex pt-16 h-full">

<!-- SIDEBAR -->
<aside id="leftsidebar"
class="sidebar fixed top-16 left-0 w-64 bg-gradient-to-b from-blue-50 to-blue-100 
dark:from-gray-900 dark:to-gray-800 shadow-lg flex flex-col transition-all duration-300 z-30 h-[calc(100vh-4rem)] -translate-x-full sm:translate-x-0">

<ul class="p-4 space-y-2">

<li class="{{ request()->routeIs('owner.dashboard') ? 'bg-blue-200 dark:bg-blue-900' : '' }} rounded-md">
<a href="{{ route('owner.dashboard') }}"
class="flex items-center gap-3 px-5 py-3 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-md transition">
<i data-lucide="layout-dashboard" class="text-blue-600 dark:text-yellow-400"></i>
<span>Dashboard</span>
</a>
</li>

<li class="{{ request()->routeIs('owner.totalPosts') ? 'bg-blue-200 dark:bg-blue-900' : '' }} rounded-md">
<a href="{{ route('owner.totalPosts') }}"
class="flex items-center gap-3 px-5 py-3 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-md transition">
<i data-lucide="file-text" class="text-blue-600 dark:text-yellow-400"></i>
<span>All Posts</span>
</a>
</li>

<li class="{{ request()->routeIs('owner.cars.index') ? 'bg-blue-200 dark:bg-blue-900' : '' }} rounded-md">
<a href="{{ route('owner.cars.index') }}"
class="flex items-center gap-3 px-5 py-3 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-md transition">
<i data-lucide="car" class="text-green-600 dark:text-yellow-400"></i>
<span>Cars</span>
</a>
</li>

<li class="{{ request()->routeIs('owner.houses.index') ? 'bg-blue-200 dark:bg-blue-900' : '' }} rounded-md">
<a href="{{ route('owner.houses.index') }}"
class="flex items-center gap-3 px-5 py-3 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-md transition">
<i data-lucide="home" class="text-purple-600 dark:text-yellow-400"></i>
<span>Houses</span>
</a>
</li>

<li class="{{ request()->routeIs('owner.customers.index') ? 'bg-blue-200 dark:bg-blue-900' : '' }} rounded-md">
<a href="{{ route('owner.customers.index') }}"
class="flex items-center gap-3 px-5 py-3 hover:bg-blue-100 dark:hover:bg-blue-800 rounded-md transition">
<i data-lucide="users" class="text-purple-600 dark:text-yellow-400"></i>
<span>Customers</span>
</a>
</li>

<li>
<a href="{{ route('owner.settings.edit') }}"
class="flex items-center gap-3 px-5 py-3 rounded-md hover:bg-blue-100 dark:hover:bg-blue-800 transition">
<i data-lucide="settings" class="text-gray-600 dark:text-yellow-400"></i>
<span>Settings</span>
</a>
</li>

<li>
<a href="{{ route('owner.recycleBin') }}"
class="flex items-center gap-3 px-5 py-3 rounded-md hover:bg-blue-100 dark:hover:bg-blue-800 transition">
<i data-lucide="trash-2" class="text-red-600 dark:text-yellow-400"></i>
<span>Recycle Bin</span>
</a>
</li>

</ul>
</aside>


<!-- MAIN -->
<main id="main-content" class="flex-1 p-6 pt-10 ml-0 sm:ml-64 transition-colors duration-300">

@yield('content')

</main>

</div>

<script>
lucide.createIcons();

// SIDEBAR MOBILE
const hamburger = document.getElementById('hamburger-btn');
const sidebar = document.getElementById('leftsidebar');

hamburger.addEventListener('click',()=>{
sidebar.classList.toggle('-translate-x-full');
});

// DARK MODE
const html = document.documentElement;
const toggle = document.getElementById('theme-toggle');
const sun = document.getElementById('sun-icon');
const moon = document.getElementById('moon-icon');

if(localStorage.theme==='dark'){html.classList.add('dark')}

function sync(){
const d=html.classList.contains('dark');
sun.classList.toggle('hidden',!d);
moon.classList.toggle('hidden',d);
}

sync();

toggle.addEventListener('click',()=>{
html.classList.toggle('dark');
localStorage.theme=html.classList.contains('dark')?'dark':'light';
sync();
});
</script>

</body>
</html>

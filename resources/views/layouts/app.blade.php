<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ethio Property</title>
    <link rel="stylesheet" href="{{ asset('assets/css/cards.css') }}">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
        }
        .transition { transition: all 0.3s ease-in-out; }
        .alert-dismissible { animation: slideIn 0.3s ease-out; }
        @keyframes slideIn { from { transform: translateY(-20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        @keyframes fadeOut { from { opacity: 1; } to { opacity: 0; } }
        .fade-out { animation: fadeOut 0.5s ease-out forwards; }

        /* Navbar colors */
        nav a { transition: all 0.3s; }
        nav a:hover { color: #0bc5ea; } /* cyan hover for links */

        /* Footer colors */
        footer { background-color: #1e1e2f; }
        footer a:hover { color: #0bc5ea; }

        /* Button hover fixes for navbar */
        .btn-primary { background-color: #1e1e2f; color: white; font-weight: 600; border-radius: 9999px; padding: 0.5rem 1rem; transition: all 0.3s; }
        .btn-primary:hover { background-color: #0bc5ea; color: #1e1e2f; }

        nav ul li a:hover span {
    width: 100%; /* underline expands on hover */
}

    </style>
    <script>
        // Auto-dismiss alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.classList.add('fade-out');
                    setTimeout(() => { alert.remove(); }, 500);
                }, 5000);
            });
        });
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="text-gray-900">

<!-- Navbar -->
<nav x-data="{ open: false }" class="bg-white fixed w-full z-50 border-b">
    <div class="w-full flex justify-between items-center pl-12 pr-0 py-3">
        <div class="flex items-center gap-3">
            

            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-2xl pr-12 font-extrabold text-slate-900">
                Ethio properties
            </a>
        </div>

        <!-- Desktop Menu -->
        <ul class="hidden md:flex mx-auto space-x-8 font-semibold text-slate-800 uppercase tracking-wide">
            <li class="relative group">
                <a href="{{ route('user.home') }}" class="hover:text-cyan-500 transition transform duration-300 scale-100 group-hover:scale-105">
                    Home
                </a>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-cyan-500 transition-all duration-300 group-hover:w-full"></span>
            </li>
            <li class="relative group">
                <a href="{{ route('houses.index') }}" class="hover:text-cyan-500 transition transform duration-300 scale-100 group-hover:scale-105">
                    Houses
                </a>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-cyan-500 transition-all duration-300 group-hover:w-full"></span>
            </li>
            <li class="relative group">
                <a href="{{ route('user.cars.index') }}" class="hover:text-cyan-500 transition transform duration-300 scale-100 group-hover:scale-105">
                    Cars
                </a>
                <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-cyan-500 transition-all duration-300 group-hover:w-full"></span>
            </li>
        </ul>

<!-- Desktop Actions -->
<div class="hidden md:flex items-center gap-3 ml-auto pr-0" x-data="{ accountOpen: false }">

    <!-- Post Button -->
    <a href="{{ route('choose.post') }}"
       class="flex items-center gap-1 px-3 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
        Post
    </a>

    <!-- Notifications -->
    <div class="relative">
        <button class="w-10 h-10 rounded-full border flex items-center justify-center hover:bg-slate-100 transition">
            🔔
        </button>
        @if(Auth::check())
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                3
            </span>
        @endif
    </div>

    <!-- Account + Dropdown -->
    <div class="relative">
        @if(Auth::check())
            <button @click="accountOpen = !accountOpen" class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-medium text-lg hover:bg-gray-700 transition">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </button>

            <!-- Dropdown -->
            <div x-show="accountOpen" @click.outside="accountOpen = false" x-transition
                class="absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden z-50 text-sm">
                
                <!-- User Info Header -->
                <div class="px-4 py-3 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full overflow-hidden border-2 border-cyan-500">
                        <img src="{{ Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : '/images/avatar.jpg' }}" alt="User Avatar" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Links -->
                <div class="flex flex-col py-2">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-cyan-50 transition">
                        <i data-lucide="user" class="w-4 h-4 text-cyan-600"></i> My Account
                    </a>
                    <a href="{{ route('choose.post') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-green-50 transition">
                        <i data-lucide="home" class="w-3 h-3 text-green-600"></i> Post Your Property
                    </a>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="border-t border-gray-100">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Log Out
                    </button>
                </form>
            </div>
@else
    <div class="relative" x-data="{ guestOpen: false }">
        <button @click="guestOpen = !guestOpen"
            class="w-10 h-10 rounded-full border flex items-center justify-center hover:bg-slate-100 transition">
            👤
        </button>

        <!-- Guest Dropdown -->
        <div x-show="guestOpen"
             @click.outside="guestOpen = false"
             x-transition
             class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">

            <a href="{{ route('login') }}"
               class="block px-4 py-2 hover:bg-gray-100 text-sm">
                Login
            </a>

            <a href="{{ route('register') }}"
               class="block px-4 py-2 hover:bg-gray-100 text-sm">
                Register
            </a>
        </div>
    </div>
@endif

    </div>

    <!-- Switch to Owner -->
    @if(Auth::check())
        <a href="{{ route('owner.dashboard') }}" class="px-3 py-1 rounded-full text-sm font-medium hover:bg-gray-100 transition">
            Switch to Owner
        </a>
    @else
        <a href="{{ route('login') }}?redirect=owner_dashboard" class="px-3 py-1 rounded-full text-sm font-medium hover:bg-gray-100 transition">
            Switch to Owner
        </a>
    @endif
</div>


        <!-- Right-side Icons (Desktop & Mobile) -->
<div class="flex items-center gap-3 ml-auto">

<!-- Right-side Icons (Mobile Only) -->
<div class="flex items-center gap-3 ml-auto md:hidden">

    <!-- Account (mobile only) -->
    <div x-data="{ accountOpen: false }" class="relative">
        @if(Auth::check())
            <button @click="accountOpen = !accountOpen" class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center font-medium text-lg hover:bg-gray-700 transition">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </button>

            <!-- Account Dropdown -->
            <div x-show="accountOpen" @click.outside="accountOpen = false" x-transition
                 class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-md text-sm z-50">
                <a href="#" class="block px-4 py-2 hover:bg-gray-100">My Account</a>
                <a href="{{ route('choose.post') }}" class="block px-4 py-2 hover:bg-gray-100">Post Your Property</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">Logout</button>
                </form>
            </div>
       @else
    <div class="relative" x-data="{ guestOpen: false }">
        <button @click="guestOpen = !guestOpen"
            class="w-10 h-10 rounded-full border flex items-center justify-center hover:bg-gray-100 transition">
            👤
        </button>

        <!-- Guest Dropdown -->
        <div x-show="guestOpen"
             @click.outside="guestOpen = false"
             x-transition
             class="absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg z-50 overflow-hidden">
            <a href="{{ route('login') }}"
               class="block px-4 py-2 hover:bg-gray-100 text-sm">
                Login
            </a>
            <a href="{{ route('register') }}"
               class="block px-4 py-2 hover:bg-gray-100 text-sm">
                Register
            </a>
        </div>
    </div>
@endif
    </div>
</div>
        <!-- Hamburger -->
    <div x-data="{ menuOpen: false }" class="relative">
        <button @click="menuOpen = !menuOpen" class="md:hidden w-10 h-10 rounded-full border flex items-center justify-center hover:bg-gray-100 transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <!-- Hamburger Dropdown -->
        <div x-show="menuOpen" @click.outside="menuOpen = false" x-transition
             class="absolute right-0 mt-2 w-36 bg-white border border-gray-200 rounded-md text-sm shadow-sm z-50">
            <a href="{{ route('user.home') }}" class="block px-4 py-2 hover:bg-gray-100">Home</a>
            <a href="{{ route('houses.index') }}" class="block px-4 py-2 hover:bg-gray-100">Houses</a>
            <a href="{{ route('user.cars.index') }}" class="block px-4 py-2 hover:bg-gray-100">Cars</a>
            <a href="{{ route('choose.post') }}" class="block px-4 py-2 hover:bg-gray-100">Post</a>
            @if(Auth::check())
                <a href="{{ route('owner.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Switch to Owner</a>
            @else
                <a href="{{ route('login') }}?redirect=owner_dashboard" class="block px-4 py-2 hover:bg-gray-100">Switch to Owner</a>
            @endif
        </div>
    </div>

</div>
    </ul>
</div>

</nav>
</nav>

    <main class="pt-20">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="container mx-auto px-6 mt-4">
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md mb-4 alert-dismissible" role="alert">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-green-700 hover:text-green-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mx-auto px-6 mt-4">
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md mb-4 alert-dismissible" role="alert">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <p class="font-medium">{{ session('error') }}</p>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="container mx-auto px-6 mt-4">
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-md mb-4" role="alert">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="font-medium mb-2">Please fix the following errors:</div>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-red-700 hover:text-red-900 ml-4">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-20 w-full block relative">
<div class="container mx-auto px-6 py-10">

    <!-- MOBILE: 2 ROWS | DESKTOP: 3 COLUMNS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- MOBILE ROW 1: Logo + Quick Links -->
        <div class="grid grid-cols-2 gap-6 md:contents">

            <!-- Logo + Description -->
            <div>
                <h3 class="text-xl font-bold mb-3">Ethio Properties</h3>
                <p>Connecting people with homes and cars they love.</p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold mb-3">Quick Links</h4>
                <ul>
                    <li><a href="#" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('houses.index') }}" class="hover:underline">Houses</a></li>
                    <li>
                        <a href="{{ route('user.cars.index') }}"
                           class="hover:underline {{ request()->routeIs('user.cars.index') ? 'text-cyan-400 font-semibold underline' : '' }}">
                           Cars
                        </a>
                    </li>
                </ul>
            </div>

        </div>
<!-- MOBILE ROW 2: Contact + Social Icons -->
<div>
    <h4 class="font-semibold mb-3">Contact</h4>

    <div class="flex flex-col md:flex-col gap-3">

        <!-- Contact Info -->
        <div>
            <p>Email: info@feeding.com</p>
            <p>Phone: +251 900 000 000</p>
        </div>

        <!-- Social Media Icons -->
<div class="flex items-center gap-4 mt-2">
    <!-- Telegram -->
    <a href="#" aria-label="Telegram" class="hover:text-cyan-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21.543 2.439a1 1 0 00-1.152-.122L2.504 10.97a1 1 0 00.034 1.835l4.873 1.942 1.942 4.872a1 1 0 001.836.033l8.653-17.886a1 1 0 00-.295-1.327zM7.545 14.1l-1.11-2.78 11.035-6.62-5.426 11.4-4.5-1.997z"/>
        </svg>
    </a>

    <!-- Instagram -->
    <a href="#" aria-label="Instagram" class="hover:text-cyan-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5zm8.75 1a.75.75 0 110 1.5.75.75 0 010-1.5zM12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z"/>
        </svg>
    </a>

    <!-- Facebook -->
    <a href="#" aria-label="Facebook" class="hover:text-cyan-400 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M22 12a10 10 0 10-11.5 9.95v-7.05h-2.7v-2.9h2.7V9.4c0-2.67 1.6-4.15 4.05-4.15 1.17 0 2.39.21 2.39.21v2.63h-1.35c-1.33 0-1.75.83-1.75 1.68v2h2.99l-.48 2.9h-2.51v7.05A10 10 0 0022 12z"/>
        </svg>
    </a>
</div>

    </div>
</div>
    </div>
</div>
        <div class="bg-slate-800 py-4 text-center text-sm">
            © 2025 Ethio properties. All rights reserved.
        </div>
    </footer>
<script src="https://cdn.jsdelivr.net/npm/lucide@1.0.2/dist/lucide.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    lucide.replace();
});
</script>
</body>
</html>

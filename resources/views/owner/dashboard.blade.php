@extends('layouts.owner')
@section('title', 'Owner Dashboard')
@section('content')
<div class="space-y-8">

    <!-- ===== HEADER ===== -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Dashboard Overview
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Track your listings and recent activity
            </p>
        </div>
        <a href="{{ route('owner.cars.create') }}"
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium shadow">
            ➕ Add New Car
        </a>
    </div>

    <!-- ===== KPI CARDS ===== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Active Listings -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500 dark:text-gray-400">Active Listings</p>
            <div class="mt-2 flex items-end justify-between">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $totalCars ?? 0 }}
                </h2>
                <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full">
                    +{{ $carsThisMonth ?? 0 }} this month
                </span>
            </div>
        </div>
        <!-- Views -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500 dark:text-gray-400">Views (Last 30 Days)</p>
            <div class="mt-2 flex items-end justify-between">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $totalViews ?? 0 }}
                </h2>
                <span class="text-xs text-indigo-600 bg-indigo-50 px-2 py-1 rounded-full">
                    {{ $viewsChange ?? '—' }}
                </span>
            </div>
        </div>

        <!-- New Inquiries -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm hover:shadow-md transition">
            <p class="text-sm text-gray-500 dark:text-gray-400">New Inquiries</p>
            <div class="mt-2 flex items-end justify-between">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                    {{ $newInquiries ?? 0 }}
                </h2>
                @if(($newInquiries ?? 0) > 0)
                    <span class="text-xs text-red-600 bg-red-50 px-2 py-1 rounded-full">
                        Needs attention
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- ===== MAIN GRID ===== -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- ===== ACTION REQUIRED ===== -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                ⚠️ Needs Attention
            </h3>
            <ul class="space-y-3 text-sm">
                @forelse($attentionItems ?? [] as $item)
                    <li class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300">
                            {{ $item['text'] }}
                        </span>
                        <a href="{{ $item['link'] }}"
                           class="text-indigo-600 hover:underline text-xs">
                            Fix
                        </a>
                    </li>
                @empty
                    <li class="text-gray-500 dark:text-gray-400">
                        Everything looks good 🎉
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- ===== RECENT ACTIVITY ===== -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">
                Recent Activity
            </h3>
            <ul class="space-y-4">
                @forelse($recentActivities ?? [] as $activity)
                    <li class="flex items-start gap-3">
                        <span class="text-xl">{{ $activity['icon'] }}</span>
                        <div>
                            <p class="text-sm text-gray-700 dark:text-gray-200">
                                {{ $activity['text'] }}
                            </p>
                            <span class="text-xs text-gray-400">
                                {{ $activity['time'] }}
                            </span>
                        </div>
                    </li>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        No recent activity yet.
                    </p>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- ===== TOP LISTINGS ===== -->
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                Top Performing Listings
            </h3>
            <a href="{{ route('owner.cars.index') }}"
               class="text-sm text-indigo-600 hover:underline">
                View all
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b dark:border-gray-700">
                        <th class="pb-2">Listing</th>
                        <th class="pb-2">Views</th>
                        <th class="pb-2">Inquiries</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($topListings ?? [] as $listing)
                        <tr class="border-b last:border-0 dark:border-gray-700">
                            <td class="py-3 text-gray-700 dark:text-gray-200">
                                {{ $listing->title }}
                            </td>
                            <td class="py-3">{{ $listing->views }}</td>
                            <td class="py-3">{{ $listing->inquiries }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-gray-500">
                                No data available yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
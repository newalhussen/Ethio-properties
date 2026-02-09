@extends('layouts.owner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 transition-colors duration-300">
    <div class="container mx-auto px-4 py-8">

        <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-6">Customers & Interactions</h2>

        <!-- Tabs -->
        <div class="flex gap-2 mb-4">
            <button class="tab-btn px-3 py-1 rounded bg-blue-500 text-white" data-tab="new-chats">New Chats</button>
            <button class="tab-btn px-3 py-1 rounded bg-gray-200 dark:bg-gray-700" data-tab="viewed-contacts">Viewed Your Contact</button>
            <button class="tab-btn px-3 py-1 rounded bg-gray-200 dark:bg-gray-700" data-tab="callbacks">Call Back Requests</button>
            <button class="tab-btn px-3 py-1 rounded bg-gray-200 dark:bg-gray-700" data-tab="saved-ads">Saved Ads</button>
        </div>

        <!-- Tab Contents -->
        <div id="tab-contents">
            <!-- New Chats -->
            <div class="tab-content" id="new-chats">
                @forelse($newChats as $msg)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-2 flex justify-between">
<div class="flex gap-3">
    <!-- Post Image -->
    @if($msg->post && $msg->post->image)
        <img src="{{ asset('storage/' . $msg->post->image) }}" 
             class="w-16 h-16 rounded object-cover">
    @endif

    <div>
        <p class="font-semibold">{{ $msg->customer->name }}</p>
        <p class="text-xs text-gray-500">{{ $msg->customer->email }}</p>

        <!-- Post Title + Price -->
        <p class="text-sm font-medium text-blue-600 mt-1">
            {{ $msg->post->title ?? 'Unknown Post' }}
            @if($msg->post?->price)
                - ${{ $msg->post->price }}
            @endif
        </p>

        <p class="text-sm mt-1">{{ $msg->content }}</p>
    </div>
</div>

                        <span class="text-xs text-green-600 font-bold">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-gray-500">No new chats.</p>
                @endforelse
            </div>

            <!-- Viewed Contacts -->
            <div class="tab-content hidden" id="viewed-contacts">
                @forelse($viewedContacts as $msg)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-2 flex justify-between">
                        <div>
                            <p class="font-semibold">{{ $msg->customer->name }}</p>
                            <p class="text-xs text-gray-500">{{ $msg->customer->email }}</p>
                            <p class="text-sm mt-1">{{ $msg->content }}</p>
                        </div>
                        <span class="text-xs text-gray-500">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-gray-500">No viewed contacts.</p>
                @endforelse
            </div>

            <!-- Call Back Requests -->
            <div class="tab-content hidden" id="callbacks">
                @forelse($callBacks as $msg)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-2 flex justify-between">
                        <div>
                            <p class="font-semibold">{{ $msg->customer->name }}</p>
                            <p class="text-xs text-gray-500">{{ $msg->customer->phone }}</p>
                            <p class="text-sm mt-1">{{ $msg->content }}</p>
                        </div>
                        <span class="text-xs text-purple-600 font-bold">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-gray-500">No call back requests.</p>
                @endforelse
            </div>

            <!-- Saved Ads -->
            <div class="tab-content hidden" id="saved-ads">
                @forelse($savedAds as $msg)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-2 flex justify-between">
                        <div>
                            <p class="font-semibold">{{ $msg->customer->name }}</p>
                            <p class="text-xs text-gray-500">{{ $msg->content ?? 'Saved your ad' }}</p>
                        </div>
                        <span class="text-xs text-blue-600 font-bold">{{ $msg->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="text-gray-500">No saved ads.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".tab-btn");
    const tabs = document.querySelectorAll(".tab-content");

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            // Reset button styles
            buttons.forEach(b => b.classList.remove("bg-blue-500", "text-white"));
            buttons.forEach(b => b.classList.add("bg-gray-200", "dark:bg-gray-700"));

            // Hide all tabs
            tabs.forEach(t => t.classList.add("hidden"));

            // Show selected tab
            document.getElementById(btn.dataset.tab).classList.remove("hidden");

            // Highlight active button
            btn.classList.add("bg-blue-500", "text-white");
            btn.classList.remove("bg-gray-200", "dark:bg-gray-700");
        });
    });
});
</script>
@endsection

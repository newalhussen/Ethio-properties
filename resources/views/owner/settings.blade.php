@extends('layouts.owner')

@section('content')
@php
    $activeTab = request('tab', 'profile'); // default tab
@endphp

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 transition-colors duration-300">

    <div class="container mx-auto px-4 py-8">

        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Settings</h2>

        {{-- Success message --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabs --}}
        <div class="flex gap-3 mb-6">
            <a href="{{ route('owner.settings.edit', ['tab' => 'profile']) }}"
               class="px-4 py-2 rounded-lg border 
               {{ $activeTab === 'profile' ? 'bg-blue-600 text-white border-blue-700' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600' }}">
               Profile
            </a>

            <a href="{{ route('owner.settings.edit', ['tab' => 'notifications']) }}"
               class="px-4 py-2 rounded-lg border 
               {{ $activeTab === 'notifications' ? 'bg-blue-600 text-white border-blue-700' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600' }}">
               Notifications
            </a>

            <a href="{{ route('owner.settings.edit', ['tab' => 'account']) }}"
               class="px-4 py-2 rounded-lg border 
               {{ $activeTab === 'account' ? 'bg-blue-600 text-white border-blue-700' : 'bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 border-gray-300 dark:border-gray-600' }}">
               Account Settings
            </a>
        </div>

        {{-- ========== PROFILE TAB ========== --}}
        @if($activeTab === 'profile')
        <form action="{{ route('owner.settings.update') }}" method="POST" enctype="multipart/form-data"
              class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md space-y-4">
            @csrf
            <input type="hidden" name="section" value="profile">

            {{-- Avatar --}}
            <div class="flex items-center gap-4">
                <label class="relative cursor-pointer group">
                    <img id="avatar-preview"
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '/images/avatar.jpg' }}"
                         class="w-20 h-20 rounded-full object-cover border-2 border-blue-400 dark:border-yellow-400">

                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                        <span class="text-sm text-white">Change</span>
                    </div>

                    <input id="avatar-input" type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                </label>
            </div>

            {{-- Name --}}
            <div>
                <label class="text-gray-700 dark:text-gray-200">Name</label>
                <input type="text" name="name" value="{{ $user->name }}"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
            </div>

            {{-- Email --}}
            <div>
                <label class="text-gray-700 dark:text-gray-200">Email</label>
                <input type="email" name="email" value="{{ $user->email }}"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
            </div>

            {{-- Phone --}}
            <div>
                <label class="text-gray-700 dark:text-gray-200">Phone</label>
                <input type="text" name="phone" value="{{ $user->phone }}"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
            </div>

            <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save Changes</button>
        </form>
        @endif


        {{-- ========== NOTIFICATIONS TAB ========== --}}
        @if($activeTab === 'notifications')
        <form action="{{ route('owner.settings.update') }}" method="POST"
              class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md space-y-4">
            @csrf
            <input type="hidden" name="section" value="notifications">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Notification Settings</h3>

            <label class="flex items-center gap-3">
                <input type="checkbox" name="email_notifications" {{ $user->email_notifications ? 'checked' : '' }}>
                <span class="text-gray-700 dark:text-gray-200">Email Notifications</span>
            </label>

            <label class="flex items-center gap-3">
                <input type="checkbox" name="sms_notifications" {{ $user->sms_notifications ? 'checked' : '' }}>
                <span class="text-gray-700 dark:text-gray-200">SMS Notifications</span>
            </label>

            <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Save</button>
        </form>
        @endif


        {{-- ========== ACCOUNT TAB ========== --}}
        @if($activeTab === 'account')
        <form action="{{ route('owner.settings.update') }}" method="POST"
              class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md space-y-4">
            @csrf
            <input type="hidden" name="section" value="account">

            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">Change Password</h3>

            <div>
                <label class="text-gray-700 dark:text-gray-200">Current Password</label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-200">
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200">New Password</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-200">
            </div>

            <div>
                <label class="text-gray-700 dark:text-gray-200">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2 rounded border bg-gray-50 dark:bg-gray-700 text-gray-200">
            </div>

            <button class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Password</button>

        </form>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md mt-6">
    <button
        type="button"
        onclick="confirmLogout()"
        class="flex items-center gap-2 px-6 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition"
    >
        <i data-lucide="log-out" class="w-4 h-4"></i>
        Logout
    </button>
</div>

        @endif
<form id="logout-form-settings" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

    </div>
</div>

<script>
document.getElementById('avatar-input')?.addEventListener('change', function(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('avatar-preview').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
<script>
function confirmLogout() {
    if (confirm('Are you sure you want to log out?')) {
        document.getElementById('logout-form-settings').submit();
    }
}
</script>

@endsection

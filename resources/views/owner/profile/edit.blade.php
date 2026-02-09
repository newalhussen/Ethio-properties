@extends('layouts.owner')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-700 transition-colors duration-300">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-200">Edit Profile</h2>
            <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                &larr; Back
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-200 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('owner.profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md space-y-4">
            @csrf

<!-- Avatar with live preview on file select -->
<div class="flex items-center gap-4">
    <label class="relative cursor-pointer group">
        <!-- Avatar Image -->
        <img id="avatar-preview" 
             src="{{ $user->avatar ? asset('storage/' . $user->avatar) : '/images/avatar.jpg' }}" 
             alt="Avatar" 
             class="w-20 h-20 rounded-full object-cover border-2 border-blue-400 dark:border-yellow-400 transition">

        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-sm text-white font-semibold">Change Profile</span>
        </div>

        <!-- Hidden file input -->
        <input id="avatar-input" type="file" name="avatar" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
    </label>
</div>



            <!-- Name -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-300 dark:focus:ring-yellow-400">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-300 dark:focus:ring-yellow-400">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" 
                       class="w-full px-4 py-2 rounded border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 focus:ring focus:ring-blue-300 dark:focus:ring-yellow-400">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
<script>
document.getElementById('avatar-input').addEventListener('change', function(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatar-preview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
});
</script>
@endsection

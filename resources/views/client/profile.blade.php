@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">👤 My Profile</h2>
    <p class="text-gray-600">Manage your profile information</p>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Profile Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Profile Information</h3>
        <div class="space-y-3">
            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="font-medium">{{ $user->full_name ?? $user->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ $user->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Role</p>
                <p class="font-medium capitalize">{{ $user->role }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Joined</p>
                <p class="font-medium">{{ $user->created_at->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Edit Profile -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Profile</h3>
        <form action="{{ route('client.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">New Password (optional)</label>
                <input type="password" name="password" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition">
                Update Profile
            </button>
        </form>
    </div>
</div>
@endsection
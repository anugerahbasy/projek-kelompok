@extends('layouts.dashboard')

@section('title', 'Client Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Client Dashboard</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Orders</div>
        <div class="text-3xl font-bold text-blue-600">0</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Orders</div>
        <div class="text-3xl font-bold text-orange-600">0</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Completed Orders</div>
        <div class="text-3xl font-bold text-green-600">0</div>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">My Profile</h3>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm text-gray-500">Name</p>
            <p class="font-medium">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Email</p>
            <p class="font-medium">{{ auth()->user()->email }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Role</p>
            <p class="font-medium capitalize">{{ auth()->user()->role }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Joined</p>
            <p class="font-medium">{{ auth()->user()->created_at->format('d M Y') }}</p>
        </div>
    </div>
</div>
@endsection
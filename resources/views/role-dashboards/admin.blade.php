@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Admin Dashboard</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Users</div>
        <div class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Admins</div>
        <div class="text-3xl font-bold text-red-600">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Managers</div>
        <div class="text-3xl font-bold text-blue-600">{{ \App\Models\User::where('role', 'manager')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Staff</div>
        <div class="text-3xl font-bold text-green-600">{{ \App\Models\User::where('role', 'staff')->count() }}</div>
    </div>
</div>
@endsection
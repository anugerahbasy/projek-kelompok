@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Admin Dashboard</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Users</div>
        <div class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Admins</div>
        <div class="text-3xl font-bold text-red-600">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Staff</div>
        <div class="text-3xl font-bold text-green-600">{{ \App\Models\User::where('role', 'staff')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Clients</div>
        <div class="text-3xl font-bold text-blue-600">{{ \App\Models\User::where('role', 'client')->count() }}</div>
    </div>
</div>

<div class="mt-6 bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.users.create') }}" class="p-4 bg-green-50 rounded-lg text-center hover:bg-green-100">
            <div class="text-2xl">➕</div>
            <div class="text-sm">Add User</div>
        </a>
        <a href="{{ route('admin.users.index') }}" class="p-4 bg-blue-50 rounded-lg text-center hover:bg-blue-100">
            <div class="text-2xl">👥</div>
            <div class="text-sm">View Users</div>
        </a>
    </div>
</div>
@endsection
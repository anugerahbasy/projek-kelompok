@extends('layouts.dashboard')

@section('title', 'Manager Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Manager Dashboard</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Staff</div>
        <div class="text-3xl font-bold text-green-600">{{ \App\Models\User::where('role', 'staff')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Kurir</div>
        <div class="text-3xl font-bold text-yellow-600">{{ \App\Models\User::where('role', 'kurir')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Clients</div>
        <div class="text-3xl font-bold text-purple-600">{{ \App\Models\User::where('role', 'client')->count() }}</div>
    </div>
</div>
@endsection
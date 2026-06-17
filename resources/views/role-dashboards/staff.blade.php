@extends('layouts.dashboard')

@section('title', 'Staff Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Staff Dashboard</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Orders</div>
        <div class="text-3xl font-bold text-orange-600">0</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Completed Orders</div>
        <div class="text-3xl font-bold text-green-600">0</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Products</div>
        <div class="text-3xl font-bold text-blue-600">0</div>
    </div>
</div>
@endsection
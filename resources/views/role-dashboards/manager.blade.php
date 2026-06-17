@extends('layouts.dashboard')

@section('title', 'Manager Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Manager Dashboard - Team Overview</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Staff</div>
        <div class="text-3xl font-bold text-green-600">{{ App\Models\User::where('role', 'staff')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Pegawai</div>
        <div class="text-3xl font-bold text-purple-600">{{ App\Models\User::where('role', 'pegawai')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Kurir</div>
        <div class="text-3xl font-bold text-yellow-600">{{ App\Models\User::where('role', 'kurir')->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Clients</div>
        <div class="text-3xl font-bold text-blue-600">{{ App\Models\User::where('role', 'client')->count() }}</div>
    </div>
</div>

<!-- Team Performance -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Team Members</h3>
        <ul class="space-y-2">
            @forelse(App\Models\User::whereIn('role', ['staff', 'pegawai', 'kurir'])->take(5)->get() as $member)
            <li class="flex justify-between items-center border-b pb-2">
                <div>
                    <span class="font-medium text-sm">{{ $member->full_name ?? $member->name }}</span>
                    <span class="text-xs text-gray-500 ml-2">{{ ucfirst($member->role) }}</span>
                </div>
                <span class="text-xs text-green-600">Active</span>
            </li>
            @empty
            <li class="text-center text-gray-500 py-4">No team members</li>
            @endforelse
        </ul>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>
        <ul class="space-y-2">
            <li class="border-b pb-2">
                <p class="text-sm">New staff member added</p>
                <p class="text-xs text-gray-500">2 hours ago</p>
            </li>
            <li class="border-b pb-2">
                <p class="text-sm">Order #123 processed</p>
                <p class="text-xs text-gray-500">5 hours ago</p>
            </li>
            <li class="border-b pb-2">
                <p class="text-sm">Delivery completed by Kurir</p>
                <p class="text-xs text-gray-500">Yesterday</p>
            </li>
        </ul>
    </div>
</div>
@endsection
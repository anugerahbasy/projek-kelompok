@extends('layouts.dashboard')

@section('title', 'Kurir Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Kurir Dashboard - Manage Deliveries</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Deliveries</div>
        <div class="text-3xl font-bold text-blue-600">{{ App\Models\Delivery::count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Deliveries</div>
        <div class="text-3xl font-bold text-orange-600">{{ App\Models\Delivery::where('status', 'pending')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">On Delivery</div>
        <div class="text-3xl font-bold text-yellow-600">{{ App\Models\Delivery::where('status', 'on_delivery')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Completed Deliveries</div>
        <div class="text-3xl font-bold text-green-600">{{ App\Models\Delivery::where('status', 'completed')->count() ?? 0 }}</div>
    </div>
</div>

<!-- Delivery List -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">My Deliveries</h3>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Delivery ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse(App\Models\Delivery::where('kurir_id', auth()->id())->latest()->take(5)->get() as $delivery)
            <tr class="border-b">
                <td class="px-4 py-2 text-sm">#{{ $delivery->id }}</td>
                <td class="px-4 py-2 text-sm">{{ $delivery->order_id ?? 'N/A' }}</td>
                <td class="px-4 py-2 text-sm">{{ Str::limit($delivery->address ?? '-', 30) }}</td>
                <td class="px-4 py-2 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($delivery->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($delivery->status == 'on_delivery') bg-blue-100 text-blue-800
                        @elseif($delivery->status == 'completed') bg-green-100 text-green-800
                        @elseif($delivery->status == 'failed') bg-red-100 text-red-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $delivery->status ?? 'Pending')) }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm">
                    <a href="#" class="text-blue-600 hover:text-blue-800">Update</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-gray-500">No deliveries assigned</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
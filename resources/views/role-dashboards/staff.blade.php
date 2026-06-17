@extends('layouts.dashboard')

@section('title', 'Staff Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Staff Dashboard - Manage Orders & Inventory</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Orders</div>
        <div class="text-3xl font-bold text-blue-600">{{ App\Models\Order::count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Orders</div>
        <div class="text-3xl font-bold text-orange-600">{{ App\Models\Order::where('status', 'pending')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Processing Orders</div>
        <div class="text-3xl font-bold text-yellow-600">{{ App\Models\Order::where('status', 'processing')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Completed Orders</div>
        <div class="text-3xl font-bold text-green-600">{{ App\Models\Order::where('status', 'completed')->count() ?? 0 }}</div>
    </div>
</div>

<!-- Recent Orders -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Orders</h3>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse(App\Models\Order::latest()->take(5)->get() as $order)
            <tr class="border-b">
                <td class="px-4 py-2 text-sm">#{{ $order->id }}</td>
                <td class="px-4 py-2 text-sm">{{ $order->user->name ?? 'Guest' }}</td>
                <td class="px-4 py-2 text-sm">Rp {{ number_format($order->total ?? 0, 0, ',', '.') }}</td>
                <td class="px-4 py-2 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800 @endif">
                        {{ ucfirst($order->status ?? 'Pending') }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm">
                    <a href="#" class="text-blue-600 hover:text-blue-800">View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-4 text-center text-gray-500">No orders found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
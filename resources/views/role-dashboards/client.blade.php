@extends('layouts.dashboard')

@section('title', 'Client Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Client Dashboard - Manage Your Stock</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Stock Items</div>
        <div class="text-3xl font-bold text-blue-600">{{ \App\Models\Product::count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Low Stock</div>
        <div class="text-3xl font-bold text-orange-600">{{ \App\Models\Product::where('stock', '<=', 5)->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Orders</div>
        <div class="text-3xl font-bold text-green-600">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Orders</div>
        <div class="text-3xl font-bold text-yellow-600">{{ \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count() }}</div>
    </div>
</div>

<!-- Stock List -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">My Stock Items</h3>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Models\Product::latest()->take(5)->get() as $product)
            <tr class="border-b">
                <td class="px-4 py-2 text-sm">{{ $product->name }}</td>
                <td class="px-4 py-2 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-4 py-2 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->stock > 10) bg-green-100 text-green-800
                        @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $product->stock }}
                    </span>
                </td>
                <td class="px-4 py-2 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->status == 'active') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-4 py-4 text-center text-gray-500">No stock items available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- My Profile -->
<div class="bg-white rounded-lg shadow p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">My Profile</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
        <div>
            <p class="text-sm text-gray-500">Total Stock Items</p>
            <p class="font-medium">{{ \App\Models\Product::count() }} products</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Total Orders</p>
            <p class="font-medium">{{ \App\Models\Order::where('user_id', auth()->id())->count() }} orders</p>
        </div>
    </div>
</div>
@endsection
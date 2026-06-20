@extends('layouts.dashboard')

@section('title', 'Detail Pengiriman')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">📋 Detail Pengiriman</h2>
    <p class="text-gray-600">Detail pengiriman #{{ $delivery->id }}</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm text-gray-500">Delivery ID</p>
            <p class="font-medium">#{{ $delivery->id }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Order</p>
            <p class="font-medium">#{{ $delivery->order_id ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Status</p>
            <span class="px-2 py-1 text-xs rounded-full 
                @if($delivery->status == 'pending') bg-yellow-100 text-yellow-800
                @elseif($delivery->status == 'on_delivery') bg-blue-100 text-blue-800
                @elseif($delivery->status == 'completed') bg-green-100 text-green-800
                @else bg-red-100 text-red-800 @endif">
                {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
            </span>
        </div>
        <div>
            <p class="text-sm text-gray-500">Phone</p>
            <p class="font-medium">{{ $delivery->phone ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-4">
        <p class="text-sm text-gray-500">Address</p>
        <p class="font-medium">{{ $delivery->address }}</p>
    </div>

    @if($delivery->notes)
    <div class="mt-4">
        <p class="text-sm text-gray-500">Notes</p>
        <p class="font-medium">{{ $delivery->notes }}</p>
    </div>
    @endif

    <div class="flex gap-3 mt-6">
        <a href="{{ route('kurir.deliveries.edit', $delivery->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Edit</a>
        <a href="{{ route('kurir.deliveries.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition">Back</a>
    </div>
</div>
@endsection
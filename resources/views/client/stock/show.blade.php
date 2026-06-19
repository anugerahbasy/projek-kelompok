@extends('layouts.dashboard')

@section('title', 'Product Details')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">📋 Product Details</h2>
    <p class="text-gray-600">View product information</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="text-sm text-gray-500">Product Name</p>
            <p class="font-medium">{{ $product->name }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">SKU</p>
            <p class="font-medium">{{ $product->sku ?? '-' }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Price</p>
            <p class="font-medium text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Stock</p>
            <p class="font-medium">{{ $product->stock }}</p>
        </div>
        <div>
            <p class="text-sm text-gray-500">Status</p>
            <span class="px-2 py-1 text-xs rounded-full 
                @if($product->status == 'active') bg-green-100 text-green-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ ucfirst($product->status) }}
            </span>
        </div>
        <div>
            <p class="text-sm text-gray-500">Added</p>
            <p class="font-medium">{{ $product->created_at->format('d M Y') }}</p>
        </div>
    </div>

    @if($product->description)
    <div class="mt-4">
        <p class="text-sm text-gray-500">Description</p>
        <p class="font-medium">{{ $product->description }}</p>
    </div>
    @endif

    @if($product->image)
    <div class="mt-4">
        <p class="text-sm text-gray-500">Image</p>
        <img src="{{ asset('storage/' . $product->image) }}" class="w-48 h-48 object-cover rounded">
    </div>
    @endif

    <div class="flex gap-3 mt-6">
        <a href="{{ route('client.stock.edit', $product) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">Edit</a>
        <a href="{{ route('client.stock.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition">Back</a>
    </div>
</div>
@endsection
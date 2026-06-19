@extends('layouts.dashboard')

@section('title', 'My Stock')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">📦 My Stock</h2>
        <p class="text-gray-600">Manage your product inventory</p>
    </div>
    <a href="{{ route('client.stock.create') }}" 
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
        + Add Product
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="flex items-center">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-10 h-10 rounded object-cover">
                        @else
                            <div class="w-10 h-10 rounded bg-gray-200 flex items-center justify-center">📦</div>
                        @endif
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ $product->sku ?? '-' }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->stock > 10) bg-green-100 text-green-800
                        @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $product->stock }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->status == 'active') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">
                    <a href="{{ route('client.stock.edit', $product) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a>
                    <a href="{{ route('client.stock.show', $product) }}" class="text-green-600 hover:text-green-800 mr-2">View</a>
                    <form action="{{ route('client.stock.destroy', $product) }}" method="POST" class="inline"
                          onsubmit="return confirm('Delete this product?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-4xl mb-2">📦</div>
                    <p class="text-lg font-medium">No products in your stock</p>
                    <p class="text-sm">Click "Add Product" to start adding items</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
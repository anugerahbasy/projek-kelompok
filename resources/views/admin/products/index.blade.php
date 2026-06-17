@extends('layouts.dashboard')

@section('title', 'Products')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Products</h2>
        <p class="text-gray-600">Manage your products inventory</p>
    </div>
    <a href="{{ route('admin.products.create') }}" 
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SKU</th>
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
                        <div class="h-10 w-10 rounded bg-gray-200 flex items-center justify-center">
                            📦
                        </div>
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                            <div class="text-sm text-gray-500">{{ Str::limit($product->description, 30) }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm text-gray-600">{{ $product->sku ?? '-' }}</td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->stock > 10) bg-green-100 text-green-800
                        @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ $product->stock }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($product->status == 'active') bg-green-100 text-green-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($product->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No products found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
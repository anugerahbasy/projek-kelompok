@extends('layouts.dashboard')

@section('title', 'My Stock')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">📦 My Stock</h2>
    <p class="text-gray-600">List of all available stock items</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
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
                            <div class="text-sm text-gray-500">{{ $product->sku ?? '-' }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </td>
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
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">No stock items available</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
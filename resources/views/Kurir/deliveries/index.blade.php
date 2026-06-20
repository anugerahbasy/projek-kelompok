@extends('layouts.dashboard')

@section('title', 'Daftar Pengiriman')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">📋 Daftar Pengiriman</h2>
        <p class="text-gray-600">Kelola semua pengiriman</p>
    </div>
    <a href="{{ route('kurir.deliveries.create') }}" 
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
        + Tambah Pengiriman
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Delivery ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deliveries as $delivery)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm">#{{ $delivery->id }}</td>
                <td class="px-6 py-4 text-sm">#{{ $delivery->order_id ?? '-' }}</td>
                <td class="px-6 py-4 text-sm">{{ Str::limit($delivery->address, 30) }}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($delivery->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($delivery->status == 'on_delivery') bg-blue-100 text-blue-800
                        @elseif($delivery->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">
                    <a href="{{ route('kurir.deliveries.show', $delivery->id) }}" class="text-blue-600 hover:text-blue-800">View</a>
                    <a href="{{ route('kurir.deliveries.edit', $delivery->id) }}" class="text-green-600 hover:text-green-800 ml-2">Edit</a>
                    <form action="{{ route('kurir.deliveries.destroy', $delivery->id) }}" method="POST" class="inline ml-2"
                          onsubmit="return confirm('Delete this delivery?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                    <div class="text-4xl mb-2">🚚</div>
                    <p class="text-lg font-medium">No deliveries assigned</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $deliveries->links() }}
    </div>
</div>
@endsection
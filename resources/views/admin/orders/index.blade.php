@extends('layouts.dashboard')

@section('title', 'Orders')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Orders</h2>
        <p class="text-gray-600">Manage all orders</p>
    </div>
    <a href="{{ route('admin.orders.create') }}" 
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
        + Create Order
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Stats -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-4 text-center">
        <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
        <div class="text-xs text-gray-500">Total</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
        <div class="text-xs text-gray-500">Pending</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 text-center">
        <div class="text-2xl font-bold text-blue-600">{{ $stats['processing'] }}</div>
        <div class="text-xs text-gray-500">Processing</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 text-center">
        <div class="text-2xl font-bold text-green-600">{{ $stats['completed'] }}</div>
        <div class="text-xs text-gray-500">Completed</div>
    </div>
    <div class="bg-white rounded-lg shadow p-4 text-center">
        <div class="text-2xl font-bold text-red-600">{{ $stats['cancelled'] }}</div>
        <div class="text-xs text-gray-500">Cancelled</div>
    </div>
</div>

<!-- Tabel Orders -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                    <div class="text-xs text-gray-500">{{ $order->items->count() }} items</div>
                </td>
                <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ $order->user->name ?? 'N/A' }}</div>
                    <div class="text-xs text-gray-500">{{ $order->user->email ?? '' }}</div>
                </td>
                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ $order->created_at->format('d M Y') }}
                </td>
                <td class="px-6 py-4 text-sm">
                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800 mr-2">View</a>
                    <a href="{{ route('admin.orders.edit', $order) }}" class="text-green-600 hover:text-green-800 mr-2">Edit</a>
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline"
                          onsubmit="return confirm('Delete this order?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No orders found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
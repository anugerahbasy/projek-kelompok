@extends('layouts.dashboard')

@section('title', 'Order Details')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Order Details</h2>
    <p class="text-gray-600">Order #{{ $order->order_number }}</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Order Info -->
    <div class="bg-white rounded-lg shadow p-6 col-span-2">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Information</h3>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-sm text-gray-500">Order Number</p>
                <p class="font-medium">{{ $order->order_number }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Status</p>
                <span class="px-2 py-1 text-xs rounded-full 
                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                    @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                    @elseif($order->status == 'completed') bg-green-100 text-green-800
                    @else bg-red-100 text-red-800 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div>
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-medium">{{ $order->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total</p>
                <p class="font-medium text-lg text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
            </div>
        </div>

        <hr class="my-4">

        <h4 class="font-semibold text-gray-800 mb-3">Items</h4>
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Product</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Qty</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Price</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-b">
                    <td class="px-4 py-2 text-sm">{{ $item->product->name ?? 'N/A' }}</td>
                    <td class="px-4 py-2 text-sm">{{ $item->quantity }}</td>
                    <td class="px-4 py-2 text-sm">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="px-4 py-2 text-right font-semibold">Total:</td>
                    <td class="px-4 py-2 font-bold text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Customer Info -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Customer</h3>
        <div>
            <p class="text-sm text-gray-500">Name</p>
            <p class="font-medium">{{ $order->user->name ?? 'N/A' }}</p>
        </div>
        <div class="mt-2">
            <p class="text-sm text-gray-500">Email</p>
            <p class="font-medium">{{ $order->user->email ?? 'N/A' }}</p>
        </div>
        <div class="mt-2">
            <p class="text-sm text-gray-500">Phone</p>
            <p class="font-medium">{{ $order->phone ?? '-' }}</p>
        </div>
        <div class="mt-2">
            <p class="text-sm text-gray-500">Shipping Address</p>
            <p class="font-medium">{{ $order->shipping_address ?? '-' }}</p>
        </div>
        @if($order->notes)
        <div class="mt-2">
            <p class="text-sm text-gray-500">Notes</p>
            <p class="font-medium">{{ $order->notes }}</p>
        </div>
        @endif

        <div class="mt-4">
            <a href="{{ route('admin.orders.edit', $order) }}" 
               class="w-full block text-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">
                Edit Order
            </a>
        </div>
        <div class="mt-2">
            <a href="{{ route('admin.orders.index') }}" 
               class="w-full block text-center px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition">
                Back to Orders
            </a>
        </div>
    </div>
</div>
@endsection
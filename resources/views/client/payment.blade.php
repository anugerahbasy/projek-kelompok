@extends('layouts.dashboard')

@section('title', 'Payment')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">💳 Payment</h2>
    <p class="text-gray-600">Manage your payments</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Spent</div>
        <div class="text-3xl font-bold text-green-600">
            Rp {{ number_format($totalSpent, 0, ',', '.') }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Payment</div>
        <div class="text-3xl font-bold text-yellow-600">
            Rp {{ number_format($pendingTotal, 0, ',', '.') }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Orders</div>
        <div class="text-3xl font-bold text-blue-600">{{ $orders->total() }}</div>
    </div>
</div>

<!-- Payment History -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <h3 class="text-lg font-semibold text-gray-800 px-6 py-4 border-b">Payment History</h3>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
                <td class="px-6 py-4 text-sm text-gray-600">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm text-gray-500">
                    {{ $order->created_at->format('d M Y') }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-gray-500">No payment history found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
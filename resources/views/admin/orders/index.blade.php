@extends('layouts.dashboard')

@section('title', 'Orders')

@section('content')
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    }
    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }
    .badge-status {
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .table-row-hover:hover {
        background-color: #f8fafc;
    }
</style>

<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">📋 Orders</h2>
            <p class="text-gray-500 text-sm mt-0.5">Kelola semua pesanan dalam sistem</p>
        </div>
        <a href="{{ route('admin.orders.create') }}" 
           class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl transition shadow-md shadow-green-100 flex items-center gap-2 text-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Order
        </a>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3">
        <span class="text-xl">✅</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

<!-- STATISTIK CARDS -->
<div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Total</p>
                <p class="text-2xl font-bold text-gray-800 mt-0.5">{{ $stats['total'] }}</p>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-500">📊</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Pending</p>
                <p class="text-2xl font-bold text-yellow-600 mt-0.5">{{ $stats['pending'] }}</p>
            </div>
            <div class="stat-icon bg-yellow-50 text-yellow-500">⏳</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Processing</p>
                <p class="text-2xl font-bold text-blue-600 mt-0.5">{{ $stats['processing'] }}</p>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-500">⚙️</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Completed</p>
                <p class="text-2xl font-bold text-green-600 mt-0.5">{{ $stats['completed'] }}</p>
            </div>
            <div class="stat-icon bg-green-50 text-green-500">✅</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Cancelled</p>
                <p class="text-2xl font-bold text-red-600 mt-0.5">{{ $stats['cancelled'] }}</p>
            </div>
            <div class="stat-icon bg-red-50 text-red-500">❌</div>
        </div>
    </div>
</div>

<!-- ORDERS TABLE -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/80">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Customer</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Total</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                <tr class="table-row-hover transition">
                    <td class="px-6 py-3.5">
                        <div>
                            <div class="text-sm font-semibold text-gray-800">{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-400">{{ $order->items->count() }} item</div>
                        </div>
                    </td>
                    <td class="px-6 py-3.5">
                        <div>
                            <div class="text-sm font-medium text-gray-800">{{ $order->user->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-400">{{ $order->user->email ?? '' }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-sm font-bold text-gray-800">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-3.5">
                        <span class="badge-status 
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($order->status == 'processing') bg-blue-100 text-blue-700
                            @elseif($order->status == 'shipped') bg-purple-100 text-purple-700
                            @elseif($order->status == 'completed') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5 text-sm text-gray-500">{{ $order->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3.5 text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.orders.show', $order->id) }}" 
                               class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Detail</a>
                            <span class="text-gray-300">|</span>
                            <a href="{{ route('admin.orders.edit', $order->id) }}" 
                               class="text-green-600 hover:text-green-800 hover:underline font-medium">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus order ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:underline font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-5xl mb-3">📋</div>
                        <p class="text-lg font-medium text-gray-600">Belum ada order</p>
                        <p class="text-sm text-gray-400">Klik "Tambah Order" untuk mulai</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3.5 border-t border-gray-100 bg-gray-50/50">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>
@endsection
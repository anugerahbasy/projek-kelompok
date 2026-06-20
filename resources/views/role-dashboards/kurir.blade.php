@extends('layouts.dashboard')

@section('title', 'Kurir Dashboard')

@section('content')
<style>
    .stat-card {
        transition: all 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }
    .map-container {
        height: 300px;
        border-radius: 12px;
        overflow: hidden;
        background: #f3f4f6;
    }
    .map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }
    .delivery-card {
        transition: all 0.2s ease;
    }
    .delivery-card:hover {
        background: #f9fafb;
    }
</style>

<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">🚚 Welcome, {{ auth()->user()->name ?? 'Kurir' }}!</h2>
            <p class="text-gray-500 text-sm">Kurir Dashboard - Manage Deliveries</p>
        </div>
        <div class="flex items-center gap-3 text-sm">
            <span class="text-gray-400">{{ now()->format('d F Y') }}</span>
            <span class="w-2 h-2 bg-green-400 rounded-full"></span>
        </div>
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl p-5 shadow-sm border text-center stat-card">
        <p class="text-xs text-gray-400 font-medium">Total</p>
        <p class="text-3xl font-bold text-blue-600">{{ $totalDeliveries ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border text-center stat-card">
        <p class="text-xs text-gray-400 font-medium">Pending</p>
        <p class="text-3xl font-bold text-yellow-600">{{ $pendingDeliveries ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border text-center stat-card">
        <p class="text-xs text-gray-400 font-medium">On Delivery</p>
        <p class="text-3xl font-bold text-blue-600">{{ $onDelivery ?? 0 }}</p>
    </div>
    <div class="bg-white rounded-xl p-5 shadow-sm border text-center stat-card">
        <p class="text-xs text-gray-400 font-medium">Completed</p>
        <p class="text-3xl font-bold text-green-600">{{ $completedDeliveries ?? 0 }}</p>
    </div>
</div>

<!-- MAP -->
<div class="bg-white rounded-xl shadow-sm border p-5 mb-6">
    <div class="flex items-center justify-between mb-3">
        <h4 class="text-sm font-medium text-gray-700">📍 Lokasi Pengiriman</h4>
        <span class="text-xs text-gray-400">Live tracking</span>
    </div>
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d100000!2d106.845!3d-6.214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1700000000000"
            allowfullscreen 
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<!-- RATING CARD -->
<div class="bg-gradient-to-r from-yellow-400 to-yellow-500 rounded-xl p-4 mb-6 text-white">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm text-white/80">⭐ Rating</p>
            <p class="text-2xl font-bold">{{ number_format($averageRating ?? 0, 1) }}</p>
        </div>
        <div>
            <p class="text-sm text-white/80">Ulasan</p>
            <p class="text-xl font-bold">{{ $totalRatings ?? 0 }}</p>
        </div>
        <a href="{{ route('kurir.ratings.index') }}" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg text-sm font-medium transition">Lihat →</a>
    </div>
</div>

<!-- DELIVERIES TABLE -->
<div class="bg-white rounded-xl shadow-sm border overflow-hidden">
    <div class="px-6 py-3 border-b bg-gray-50/50 flex items-center justify-between">
        <h3 class="font-semibold text-gray-700 text-sm">📋 My Deliveries</h3>
        <span class="text-xs text-gray-400">{{ isset($deliveries) ? $deliveries->total() : 0 }} pengiriman</span>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50/80">
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($deliveries ?? [] as $delivery)
                <tr class="hover:bg-gray-50/60 border-b delivery-card">
                    <td class="px-4 py-3 font-medium text-gray-800">#{{ $delivery->id }}</td>
                    <td class="px-4 py-3 text-gray-600">#{{ $delivery->order_id ?? '-' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ Str::limit($delivery->address, 25) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold 
                            @if($delivery->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($delivery->status == 'on_delivery') bg-blue-100 text-blue-700
                            @elseif($delivery->status == 'completed') bg-green-100 text-green-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('kurir.deliveries.show', $delivery->id) }}" class="text-blue-600 hover:text-blue-800 font-medium hover:underline">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                        <div class="text-4xl mb-2">🚚</div>
                        <p class="text-sm font-medium text-gray-500">No deliveries assigned</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($deliveries) && method_exists($deliveries, 'links'))
    <div class="px-4 py-3 border-t bg-gray-50/50">
        {{ $deliveries->links() }}
    </div>
    @endif
</div>
@endsection
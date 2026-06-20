@extends('layouts.dashboard')

@section('title', 'Kurir Dashboard')

@section('content')
<!-- HEADER -->
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">🚚 Welcome, {{ auth()->user()->name ?? 'Kurir' }}!</h2>
            <p class="text-gray-500">Kurir Dashboard - Manage Deliveries</p>
        </div>
        <span class="text-sm text-gray-400">{{ now()->format('d F Y') }}</span>
    </div>
</div>

<!-- STATS -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-5 text-center border">
        <p class="text-2xl font-bold text-blue-600">{{ $totalDeliveries ?? 0 }}</p>
        <p class="text-sm text-gray-500">Total</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center border">
        <p class="text-2xl font-bold text-yellow-600">{{ $pendingDeliveries ?? 0 }}</p>
        <p class="text-sm text-gray-500">Pending</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center border">
        <p class="text-2xl font-bold text-blue-600">{{ $onDelivery ?? 0 }}</p>
        <p class="text-sm text-gray-500">On Delivery</p>
    </div>
    <div class="bg-white rounded-lg shadow p-5 text-center border">
        <p class="text-2xl font-bold text-green-600">{{ $completedDeliveries ?? 0 }}</p>
        <p class="text-sm text-gray-500">Completed</p>
    </div>
</div>

<!-- RATING CARD -->
<div class="bg-white rounded-lg shadow p-5 border mb-6">
    <div class="flex items-center gap-4">
        <div class="text-4xl">⭐</div>
        <div>
            <p class="text-2xl font-bold text-yellow-500">{{ number_format($averageRating ?? 0, 1) }}</p>
            <p class="text-sm text-gray-500">Rating ({{ $totalRatings ?? 0 }} ulasan)</p>
        </div>
    </div>
</div>

<!-- RECENT REVIEWS -->
@if(isset($recentRatings) && $recentRatings->count() > 0)
<div class="bg-white rounded-lg shadow p-5 border mb-6">
    <h3 class="font-semibold text-gray-700 mb-3">⭐ Ulasan Terbaru</h3>
    <div class="space-y-2">
        @foreach($recentRatings as $rating)
        <div class="border-b pb-2">
            <div class="flex items-center justify-between">
                <span class="font-medium">{{ $rating->user->name ?? 'User' }}</span>
                <span class="text-yellow-500">
                    @for($i=1; $i<=5; $i++) @if($i <= $rating->rating) ★ @else ☆ @endif @endfor
                </span>
            </div>
            @if($rating->review) <p class="text-sm text-gray-600">"{{ $rating->review }}"</p> @endif
            <span class="text-xs text-gray-400">{{ $rating->created_at->diffForHumans() }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- DELIVERIES TABLE -->
<div class="bg-white rounded-lg shadow border overflow-hidden">
    <div class="px-6 py-3 border-b bg-gray-50">
        <h3 class="font-semibold text-gray-700">📋 My Deliveries</h3>
    </div>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rating</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deliveries ?? [] as $delivery)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-3 text-sm">#{{ $delivery->id }}</td>
                <td class="px-6 py-3 text-sm">#{{ $delivery->order_id ?? '-' }}</td>
                <td class="px-6 py-3 text-sm">{{ Str::limit($delivery->address, 25) }}</td>
                <td class="px-6 py-3">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($delivery->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($delivery->status == 'on_delivery') bg-blue-100 text-blue-800
                        @elseif($delivery->status == 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($delivery->status) }}
                    </span>
                </td>
                <td class="px-6 py-3">
                    @php $rating = \App\Models\Rating::where('delivery_id', $delivery->id)->first(); @endphp
                    @if($rating)
                        <span class="text-yellow-500">@for($i=1;$i<=5;$i++)@if($i<=$rating->rating)★@else☆@endif@endfor</span>
                    @else
                        <span class="text-gray-400 text-xs">-</span>
                    @endif
                </td>
                <td class="px-6 py-3 text-sm">
                    <a href="{{ route('kurir.deliveries.show', $delivery->id) }}" class="text-blue-600 hover:underline">Detail</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">No deliveries assigned</td></tr>
            @endforelse
        </tbody>
    </table>
    @if(isset($deliveries) && method_exists($deliveries, 'links'))
    <div class="px-6 py-3 border-t">{{ $deliveries->links() }}</div>
    @endif
</div>
@endsection
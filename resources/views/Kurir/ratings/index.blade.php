@extends('layouts.dashboard')

@section('title', 'Rating & Ulasan')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">⭐ Rating & Ulasan</h2>
    <p class="text-gray-500">Lihat semua rating dan ulasan dari pelanggan</p>
</div>

<!-- RATING SUMMARY -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow p-6 text-center border">
        <p class="text-sm text-gray-500">Rating Rata-rata</p>
        <p class="text-4xl font-bold text-yellow-500">{{ number_format($averageRating ?? 0, 1) }}</p>
        <p class="text-sm text-gray-400">Dari {{ $totalRatings ?? 0 }} ulasan</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 border">
        <p class="text-sm text-gray-500 mb-2">Distribusi Rating</p>
        @for($i=5; $i>=1; $i--)
        @php
            $count = $ratingStats[$i] ?? 0;
            $total = $totalRatings ?? 0;
            $pct = $total > 0 ? round(($count / $total) * 100) : 0;
        @endphp
        <div class="flex items-center gap-2 mb-1">
            <span class="text-sm w-8">{{ $i }}⭐</span>
            <div class="flex-1 bg-gray-200 rounded-full h-2 overflow-hidden">
               
            </div>
            <span class="text-sm text-gray-500 w-8">{{ $count }}</span>
        </div>
        @endfor
    </div>
</div>

<!-- LIST RATING -->
<div class="bg-white rounded-lg shadow border overflow-hidden">
    <div class="px-6 py-3 border-b bg-gray-50">
        <h3 class="font-semibold text-gray-700">📋 Semua Ulasan</h3>
    </div>
    <div class="divide-y">
        @forelse($ratings as $rating)
        <div class="px-6 py-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-medium text-gray-800">{{ $rating->user->name ?? 'User' }}</p>
                    <p class="text-yellow-500">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $rating->rating) ★ @else ☆ @endif
                        @endfor
                    </p>
                </div>
                <span class="text-xs text-gray-400">{{ $rating->created_at->format('d M Y') }}</span>
            </div>
            @if($rating->review)
                <p class="text-sm text-gray-600 mt-1">"{{ $rating->review }}"</p>
            @endif
        </div>
        @empty
        <div class="px-6 py-8 text-center text-gray-500">
            <p class="text-4xl mb-2">⭐</p>
            <p>Belum ada rating</p>
        </div>
        @endforelse
    </div>
    @if(isset($ratings) && method_exists($ratings, 'links'))
    <div class="px-6 py-3 border-t">{{ $ratings->links() }}</div>
    @endif
</div>
@endsection
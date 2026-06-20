@extends('layouts.dashboard')

@section('title', 'Client Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">👋 Welcome, {{ auth()->user()->name ?? 'User' }}!</h2>
    <p class="text-gray-500">Client Dashboard - Manage Your Stock</p>
</div>

<!-- STATISTIK -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
        <div class="text-2xl font-bold text-blue-600">{{ \App\Models\Product::where('user_id', auth()->id())->count() }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Stock</div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
        <div class="text-2xl font-bold text-yellow-600">{{ \App\Models\Product::where('user_id', auth()->id())->where('stock', '<=', 5)->count() }}</div>
        <div class="text-sm text-gray-500 mt-1">Low Stock</div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
        <div class="text-2xl font-bold text-green-600">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</div>
        <div class="text-sm text-gray-500 mt-1">Total Orders</div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 text-center">
        <div class="text-2xl font-bold text-orange-600">{{ \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count() }}</div>
        <div class="text-sm text-gray-500 mt-1">Pending</div>
    </div>
</div>

<!-- GRAFIK -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="text-gray-700 font-medium mb-3">📊 Stock Distribution</h3>
        <div style="height: 250px;">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="text-gray-700 font-medium mb-3">📈 Monthly Activity</h3>
        <div style="height: 250px;">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
</div>

<!-- My Stock -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <div class="px-6 py-3 border-b bg-gray-50 flex justify-between items-center">
        <h3 class="font-semibold text-gray-700">📦 My Stock</h3>
        <a href="{{ route('client.stock.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
    </div>
    <table class="w-full text-sm">
        <thead class="bg-gray-50/50">
            <tr>
                <th class="px-6 py-2 text-left text-gray-500 text-xs">Product</th>
                <th class="px-6 py-2 text-left text-gray-500 text-xs">Price</th>
                <th class="px-6 py-2 text-left text-gray-500 text-xs">Stock</th>
                <th class="px-6 py-2 text-left text-gray-500 text-xs">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse(\App\Models\Product::where('user_id', auth()->id())->latest()->take(5)->get() as $item)
            <tr class="border-t">
                <td class="px-6 py-2">{{ $item->name }}</td>
                <td class="px-6 py-2">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                <td class="px-6 py-2">
                    @if($item->stock > 10)
                        <span class="text-green-600">{{ $item->stock }}</span>
                    @elseif($item->stock > 0)
                        <span class="text-yellow-600">{{ $item->stock }}</span>
                    @else
                        <span class="text-red-600">{{ $item->stock }}</span>
                    @endif
                </td>
                <td class="px-6 py-2">
                    @if($item->status == 'active')
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">Active</span>
                    @else
                        <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded text-xs">Inactive</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="px-6 py-4 text-center text-gray-400">Belum ada produk</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Profile & Payment -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-3">👤 My Profile</h3>
        <div class="space-y-2 text-sm">
            <div><span class="text-gray-500">Name:</span> {{ auth()->user()->name }}</div>
            <div><span class="text-gray-500">Email:</span> {{ auth()->user()->email }}</div>
            <div><span class="text-gray-500">Role:</span> {{ auth()->user()->role }}</div>
            <div><span class="text-gray-500">Joined:</span> {{ auth()->user()->created_at->format('d M Y') }}</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
        <h3 class="font-semibold text-gray-700 mb-3">💳 Payment</h3>
        <div class="space-y-2 text-sm">
            <div><span class="text-gray-500">Total Spent:</span> Rp 0</div>
            <div><span class="text-gray-500">Pending:</span> Rp 0</div>
            <div><span class="text-gray-500">Total Orders:</span> {{ \App\Models\Order::where('user_id', auth()->id())->count() }}</div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // GRAFIK 1: DOUGHNUT
    const canvas1 = document.getElementById('myChart');
    if (canvas1) {
        new Chart(canvas1, {
            type: 'doughnut',
            data: {
                labels: ['Stok Aman', 'Stok Sedang', 'Stok Habis'],
                datasets: [{
                    data: [2, 1, 0],
                    backgroundColor: ['#22c55e', '#eab308', '#ef4444'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 16,
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    }

    // GRAFIK 2: LINE
    const canvas2 = document.getElementById('myChart2');
    if (canvas2) {
        new Chart(canvas2, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Aktivitas',
                    data: [3, 5, 2, 7, 4, 6, 8],
                    borderColor: '#4facfe',
                    backgroundColor: 'rgba(79, 172, 254, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4facfe',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

});
</script>
@endsection
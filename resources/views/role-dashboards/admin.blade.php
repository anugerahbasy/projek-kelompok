@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .glass {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    .gradient-text {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .bg-gradient-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .bg-gradient-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
    .bg-gradient-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
    .bg-gradient-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
    .bg-gradient-5 { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.2;
    }
    .stat-label {
        font-size: 0.85rem;
        font-weight: 500;
        opacity: 0.8;
    }
    .chart-container {
        height: 280px;
        position: relative;
    }
    .badge-modern {
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }
</style>

<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">📊 Dashboard</h1>
            <p class="text-gray-500 mt-1">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}!</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-400">{{ now()->format('d F Y') }}</span>
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
        </div>
    </div>
</div>

<!-- STATISTIK CARDS - MODERN -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Users</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUsers ?? 9 }}</p>
                <div class="flex items-center gap-1 mt-3 text-xs text-green-500">
                    <span>▲ 12%</span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-2xl">
                👥
            </div>
        </div>
        <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full w-3/4 bg-gradient-1 rounded-full"></div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Admin</p>
                <p class="text-3xl font-bold text-red-500 mt-1">{{ $totalAdmin ?? 2 }}</p>
                <div class="flex items-center gap-1 mt-3 text-xs text-green-500">
                    <span>▲ 8%</span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center text-2xl">
                🛡️
            </div>
        </div>
        <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full w-2/4 bg-gradient-2 rounded-full"></div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Kurir</p>
                <p class="text-3xl font-bold text-yellow-500 mt-1">{{ $totalKurir ?? 2 }}</p>
                <div class="flex items-center gap-1 mt-3 text-xs text-green-500">
                    <span>▲ 15%</span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center text-2xl">
                🚚
            </div>
        </div>
        <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full w-1/2 bg-gradient-3 rounded-full"></div>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-start justify-between">
            <div>
                <p class="text-gray-400 text-sm font-medium">Total Client</p>
                <p class="text-3xl font-bold text-green-500 mt-1">{{ $totalClient ?? 2 }}</p>
                <div class="flex items-center gap-1 mt-3 text-xs text-green-500">
                    <span>▲ 10%</span>
                    <span class="text-gray-400">dari bulan lalu</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-2xl">
                👤
            </div>
        </div>
        <div class="mt-4 h-1 w-full bg-gray-100 rounded-full overflow-hidden">
            <div class="h-full w-3/5 bg-gradient-4 rounded-full"></div>
        </div>
    </div>
</div>

<!-- GRAFIK - MODERN -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-gray-800 font-semibold">👥 Distribusi User</h3>
                <p class="text-gray-400 text-xs">Berdasarkan role</p>
            </div>
            <span class="badge-modern bg-blue-50 text-blue-600">Real-time</span>
        </div>
        <div class="chart-container">
            <canvas id="userChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-gray-800 font-semibold">📦 Status Order</h3>
                <p class="text-gray-400 text-xs">Distribusi status order</p>
            </div>
            <span class="badge-modern bg-green-50 text-green-600">Aktif</span>
        </div>
        <div class="chart-container">
            <canvas id="orderChart"></canvas>
        </div>
    </div>
</div>

<!-- GRAFIK BAWAH -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-gray-800 font-semibold">📈 Aktivitas User</h3>
                <p class="text-gray-400 text-xs">7 hari terakhir</p>
            </div>
            <span class="badge-modern bg-purple-50 text-purple-600">Trend</span>
        </div>
        <div class="chart-container">
            <canvas id="activityChart"></canvas>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-6 shadow-sm card-hover border border-gray-50">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-gray-800 font-semibold">🚚 Kinerja Kurir</h3>
                <p class="text-gray-400 text-xs">Total pengiriman</p>
            </div>
            <span class="badge-modern bg-yellow-50 text-yellow-600">Leaderboard</span>
        </div>
        <div class="chart-container">
            <canvas id="kurirChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // 1. DOUGHNUT CHART
    const ctx1 = document.getElementById('userChart');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'Kurir', 'Client'],
                datasets: [{
                    data: [2, 2, 2],
                    backgroundColor: ['#764ba2', '#f093fb', '#4facfe'],
                    borderWidth: 0,
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '72%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: { size: 12, weight: '500' }
                        }
                    }
                }
            }
        });
    }

    // 2. BAR CHART
    const ctx2 = document.getElementById('orderChart');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Pending', 'Processing', 'Completed', 'Cancelled'],
                datasets: [{
                    label: 'Jumlah Order',
                    data: [4, 3, 8, 1],
                    backgroundColor: [
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(59, 130, 246, 0.8)',
                        'rgba(52, 211, 153, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444'],
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { 
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // 3. LINE CHART
    const ctx3 = document.getElementById('activityChart');
    if (ctx3) {
        new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'User Baru',
                    data: [3, 5, 2, 7, 4, 6, 8],
                    borderColor: '#4facfe',
                    backgroundColor: 'rgba(79, 172, 254, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#4facfe',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }, {
                    label: 'Order Baru',
                    data: [2, 4, 3, 6, 5, 7, 9],
                    borderColor: '#43e97b',
                    backgroundColor: 'rgba(67, 233, 123, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#43e97b',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 16,
                            font: { size: 12 }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0,0,0,0.04)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    // 4. KURIR CHART
    const ctx4 = document.getElementById('kurirChart');
    if (ctx4) {
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: ['Kurir 1', 'Kurir 2'],
                datasets: [{
                    label: 'Pengiriman',
                    data: [12, 8],
                    backgroundColor: [
                        'rgba(118, 75, 162, 0.8)',
                        'rgba(240, 147, 251, 0.8)'
                    ],
                    borderColor: ['#764ba2', '#f093fb'],
                    borderWidth: 2,
                    borderRadius: 8,
                    barPercentage: 0.5
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

});
</script>

@endsection
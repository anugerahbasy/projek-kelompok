@extends('layouts.dashboard')

@section('title', 'Products')

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
    .badge-role {
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .table-row-hover:hover {
        background-color: #f8fafc;
    }
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        background: #f1f5f9;
    }
    .avatar-blue { background: #dbeafe; }
    .avatar-green { background: #d1fae5; }
    .avatar-yellow { background: #fef3c7; }
    .avatar-red { background: #fee2e2; }
</style>

<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">📦 Products</h2>
            <p class="text-gray-500 text-sm mt-0.5">Kelola semua produk dalam sistem</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl transition shadow-md shadow-green-100 flex items-center gap-2 text-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Produk
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

@if(session('error'))
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3">
        <span class="text-xl">❌</span>
        <span>{{ session('error') }}</span>
    </div>
@endif

<!-- STATISTIK CARDS -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Total Produk</p>
                <p class="text-2xl font-bold text-gray-800 mt-0.5">{{ \App\Models\Product::count() }}</p>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-500">📦</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Total Stok</p>
                <p class="text-2xl font-bold text-green-600 mt-0.5">{{ \App\Models\Product::sum('stock') }}</p>
            </div>
            <div class="stat-icon bg-green-50 text-green-500">📊</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Stok Menipis</p>
                <p class="text-2xl font-bold text-yellow-600 mt-0.5">{{ \App\Models\Product::where('stock', '<=', 5)->count() }}</p>
            </div>
            <div class="stat-icon bg-yellow-50 text-yellow-500">⚠️</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Stok Habis</p>
                <p class="text-2xl font-bold text-red-600 mt-0.5">{{ \App\Models\Product::where('stock', 0)->count() }}</p>
            </div>
            <div class="stat-icon bg-red-50 text-red-500">🚫</div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/80">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Produk</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">SKU</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Stok</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                <tr class="table-row-hover transition">
                    <td class="px-6 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="avatar 
                                @if($product->status == 'active') avatar-green
                                @else avatar-gray @endif">
                                📦
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-800">{{ $product->name }}</div>
                                <div class="text-xs text-gray-400">{{ Str::limit($product->description, 30) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-sm text-gray-600">{{ $product->sku ?? '-' }}</td>
                    <td class="px-6 py-3.5 text-sm font-semibold text-gray-800">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-3.5 text-sm">
                        <span class="badge-role 
                            @if($product->stock > 10) bg-green-100 text-green-700
                            @elseif($product->stock > 0) bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5">
                        <span class="badge-role 
                            @if($product->status == 'active') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($product->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5 text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
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
                        <div class="text-5xl mb-3">📦</div>
                        <p class="text-lg font-medium text-gray-600">Belum ada produk</p>
                        <p class="text-sm text-gray-400">Klik "Tambah Produk" untuk mulai</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3.5 border-t border-gray-100 bg-gray-50/50">
        {{ $products->appends(request()->query())->links() }}
    </div>
</div>
@endsection
@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')
<style>
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin: 0 auto;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    }
</style>

<div class="mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">👤 My Profile</h2>
        <p class="text-gray-500 text-sm">Kelola informasi profil Anda</p>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3">
        <span class="text-xl">✅</span>
        <span>{{ session('success') }}</span>
    </div>
@endif

@if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-4 flex items-center gap-3">
        <span class="text-xl">❌</span>
        <span>{{ session('error') }}</span>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Profile Card -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center stat-card">
            <div class="profile-avatar">
                {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
            </div>
            <h3 class="text-lg font-semibold text-gray-800 mt-4">{{ $user->name }}</h3>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>
            <div class="mt-3">
                <span class="inline-block bg-blue-50 text-blue-600 text-xs font-medium px-3 py-1 rounded-full">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
            <div class="mt-5 pt-4 border-t border-gray-100 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Bergabung</span>
                    <span class="font-medium text-gray-700">{{ $user->created_at->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Stock</span>
                    <span class="font-medium text-gray-700">{{ \App\Models\Product::where('user_id', $user->id)->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Orders</span>
                    <span class="font-medium text-gray-700">{{ \App\Models\Order::where('user_id', $user->id)->count() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Profile Form -->
    <div class="lg:col-span-3">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-5">✏️ Edit Profile</h3>
            <form action="{{ route('client.profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition" required>
                        @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Last Name <span class="text-red-500">*</span></label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition" required>
                        @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition" required>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Password Baru <span class="text-gray-400 text-xs">(opsional)</span></label>
                        <input type="password" name="password" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition">
                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" 
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition">
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-3">
                    <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white rounded-lg transition text-sm font-medium shadow-sm shadow-green-100">
                        💾 Simpan Perubahan
                    </button>
                    <a href="{{ route('client.dashboard') }}" class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition text-sm font-medium">
                        ⬅️ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
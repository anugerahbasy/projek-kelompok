@extends('layouts.dashboard')

@section('title', 'Manage Users')

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
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.8rem;
        color: white;
    }
    .avatar-blue { background: linear-gradient(135deg, #4facfe, #00f2fe); }
    .avatar-red { background: linear-gradient(135deg, #f093fb, #f5576c); }
    .avatar-yellow { background: linear-gradient(135deg, #f6d365, #fda085); }
    .avatar-green { background: linear-gradient(135deg, #43e97b, #38f9d7); }
    .avatar-purple { background: linear-gradient(135deg, #a18cd1, #fbc2eb); }
    .avatar-gray { background: linear-gradient(135deg, #cfd9df, #e2ebf0); }
</style>

<div class="mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">👥 Manage Users</h2>
            <p class="text-gray-500 text-sm mt-0.5">Kelola semua user dalam sistem</p>
        </div>
        <a href="{{ route('admin.users.create') }}" 
           class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-xl transition shadow-md shadow-green-100 flex items-center gap-2 text-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah User
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
                <p class="text-sm font-medium text-gray-400">Total Users</p>
                <p class="text-2xl font-bold text-gray-800 mt-0.5">{{ \App\Models\User::count() }}</p>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-500">👥</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Admins</p>
                <p class="text-2xl font-bold text-red-600 mt-0.5">{{ \App\Models\User::where('role', 'admin')->count() }}</p>
            </div>
            <div class="stat-icon bg-red-50 text-red-500">🛡️</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Kurir</p>
                <p class="text-2xl font-bold text-yellow-600 mt-0.5">{{ \App\Models\User::where('role', 'kurir')->count() }}</p>
            </div>
            <div class="stat-icon bg-yellow-50 text-yellow-500">🚚</div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-100 card-hover">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-400">Clients</p>
                <p class="text-2xl font-bold text-green-600 mt-0.5">{{ \App\Models\User::where('role', 'client')->count() }}</p>
            </div>
            <div class="stat-icon bg-green-50 text-green-500">👤</div>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div class="bg-white rounded-xl shadow-sm p-4 mb-6 border border-gray-100">
    <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
        <div class="flex-1">
            <input type="text" name="search" value="{{ request('search') }}" 
                   placeholder="Cari berdasarkan nama atau email..." 
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm transition">
        </div>
        <div>
            <select name="role" class="w-full md:w-44 px-4 py-2.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 text-sm bg-white transition">
                <option value="">Semua Role</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kurir" {{ request('role') == 'kurir' ? 'selected' : '' }}>Kurir</option>
                <option value="client" {{ request('role') == 'client' ? 'selected' : '' }}>Client</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-xl transition text-sm font-medium shadow-sm">
                🔍 Cari
            </button>
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl transition text-sm font-medium">
                Reset
            </a>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50/80">
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Bergabung</th>
                    <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="table-row-hover transition">
                    <td class="px-6 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="avatar 
                                @if($user->isAdmin()) avatar-red
                                @elseif($user->isKurir()) avatar-yellow
                                @elseif($user->isClient()) avatar-green
                                @else avatar-gray @endif">
                                {{ strtoupper(substr($user->name ?? $user->email, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-800">{{ $user->name ?? 'N/A' }}</div>
                                <div class="text-xs text-gray-400">ID: #{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-3.5 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="px-6 py-3.5">
                        <span class="badge-role 
                            @if($user->isAdmin()) bg-red-100 text-red-700
                            @elseif($user->isKurir()) bg-yellow-100 text-yellow-700
                            @elseif($user->isClient()) bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-700 @endif">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-3.5 text-sm">
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" 
                               class="text-blue-600 hover:text-blue-800 hover:underline font-medium">Edit</a>
                            <span class="text-gray-300">|</span>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" 
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 hover:underline font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="text-5xl mb-3">📭</div>
                        <p class="text-lg font-medium text-gray-600">Belum ada user</p>
                        <p class="text-sm text-gray-400">Klik "Tambah User" untuk mulai</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-3.5 border-t border-gray-100 bg-gray-50/50">
        {{ $users->appends(request()->query())->links() }}
    </div>
</div>
@endsection
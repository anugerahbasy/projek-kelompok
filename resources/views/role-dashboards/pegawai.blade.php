@extends('layouts.dashboard')

@section('title', 'Pegawai Dashboard')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome, {{ auth()->user()->full_name ?? auth()->user()->name }}!</h2>
    <p class="text-gray-600">Pegawai Dashboard - Manage Tasks & Projects</p>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Tasks</div>
        <div class="text-3xl font-bold text-blue-600">{{ App\Models\Task::count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Tasks</div>
        <div class="text-3xl font-bold text-orange-600">{{ App\Models\Task::where('status', 'pending')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">In Progress</div>
        <div class="text-3xl font-bold text-yellow-600">{{ App\Models\Task::where('status', 'in_progress')->count() ?? 0 }}</div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Completed Tasks</div>
        <div class="text-3xl font-bold text-green-600">{{ App\Models\Task::where('status', 'completed')->count() ?? 0 }}</div>
    </div>
</div>

<!-- My Tasks -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">My Tasks</h3>
        <ul class="space-y-2">
            @forelse(App\Models\Task::where('assigned_to', auth()->id())->latest()->take(5)->get() as $task)
            <li class="flex justify-between items-center border-b pb-2">
                <span class="text-sm">{{ $task->title }}</span>
                <span class="text-xs px-2 py-1 rounded-full 
                    @if($task->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($task->status == 'in_progress') bg-blue-100 text-blue-800
                    @elseif($task->status == 'completed') bg-green-100 text-green-800 @endif">
                    {{ ucfirst(str_replace('_', ' ', $task->status ?? 'Pending')) }}
                </span>
            </li>
            @empty
            <li class="text-center text-gray-500 py-4">No tasks assigned</li>
            @endforelse
        </ul>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">My Profile</h3>
        <div class="space-y-2">
            <div>
                <p class="text-sm text-gray-500">Name</p>
                <p class="font-medium">{{ auth()->user()->full_name ?? auth()->user()->name }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-medium">{{ auth()->user()->email }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Role</p>
                <p class="font-medium capitalize">{{ auth()->user()->role }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500">Department</p>
                <p class="font-medium">Operations</p>
            </div>
        </div>
    </div>
</div>
@endsection
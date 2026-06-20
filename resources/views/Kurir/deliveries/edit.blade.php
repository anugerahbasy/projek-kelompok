@extends('layouts.dashboard')

@section('title', 'Edit Pengiriman')

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">✏️ Edit Pengiriman</h2>
    <p class="text-gray-600">Update pengiriman</p>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-2xl">
    <form action="{{ route('kurir.deliveries.update', $delivery->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea name="address" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>{{ old('address', $delivery->address) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $delivery->phone) }}" 
                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">
                <option value="pending" {{ $delivery->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="on_delivery" {{ $delivery->status == 'on_delivery' ? 'selected' : '' }}>On Delivery</option>
                <option value="completed" {{ $delivery->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ $delivery->status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
            <textarea name="notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500">{{ old('notes', $delivery->notes) }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('kurir.deliveries.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg transition">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">Update</button>
        </div>
    </form>
</div>
@endsection
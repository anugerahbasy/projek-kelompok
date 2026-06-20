@extends('layouts.dashboard')

@section('title', 'Payment')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">💳 Payment</h2>
        <p class="text-gray-600">Kelola pembayaran dan top up saldo</p>
    </div>
    <a href="{{ route('client.payment.create') }}" 
       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
        + Top Up Saldo
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Spent</div>
        <div class="text-3xl font-bold text-green-600">
            Rp {{ number_format($totalSpent ?? 0, 0, ',', '.') }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Pending Payment</div>
        <div class="text-3xl font-bold text-yellow-600">
            Rp {{ number_format($pendingTotal ?? 0, 0, ',', '.') }}
        </div>
    </div>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="text-sm text-gray-500">Total Orders</div>
        <div class="text-3xl font-bold text-blue-600">{{ $payments->total() ?? 0 }}</div>
    </div>
</div>

<!-- Payment History -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <h3 class="text-lg font-semibold text-gray-800 px-6 py-4 border-b">Payment History</h3>
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm font-medium">{{ $payment->payment_id }}</td>
                <td class="px-6 py-4 text-sm">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                <td class="px-6 py-4 text-sm capitalize">{{ str_replace('_', ' ', $payment->method) }}</td>
                <td class="px-6 py-4 text-sm">
                    <span class="px-2 py-1 text-xs rounded-full 
                        @if($payment->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($payment->status == 'success') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($payment->status) }}
                    </span>
                </td>
                <td class="px-6 py-4 text-sm">{{ $payment->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-sm">
                    @if($payment->status == 'pending')
                    <form action="{{ route('client.payment.update', $payment->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="success">
                        <button type="submit" class="text-green-600 hover:text-green-800 mr-2">Bayar</button>
                    </form>
                    <form action="{{ route('client.payment.update', $payment->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="failed">
                        <button type="submit" class="text-red-600 hover:text-red-800 mr-2">Batal</button>
                    </form>
                    @endif
                    <form action="{{ route('client.payment.destroy', $payment->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('Delete this payment?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-gray-500">Belum ada riwayat pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $payments->links() }}
    </div>
</div>
@endsection
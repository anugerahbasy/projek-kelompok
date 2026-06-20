<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // TAMPILKAN HALAMAN PAYMENT
    public function index()
    {
        $userId = Auth::id();
        
        $payments = Payment::where('user_id', $userId)
            ->latest()
            ->paginate(10);
            
        $totalSpent = Payment::where('user_id', $userId)
            ->where('status', 'success')
            ->sum('amount');
            
        $pendingTotal = Payment::where('user_id', $userId)
            ->where('status', 'pending')
            ->sum('amount');

        return view('client.payment', compact('payments', 'totalSpent', 'pendingTotal'));
    }

    // FORM TOP UP SALDO
    public function create()
    {
        return view('client.payment.create');
    }

    // PROSES TOP UP SALDO
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|in:bank_transfer,credit_card,e_wallet',
        ]);

        $payment = Payment::create([
            'user_id' => Auth::id(),
            'payment_id' => Payment::generatePaymentId(),
            'amount' => $request->amount,
            'status' => 'pending',
            'method' => $request->method,
            'notes' => $request->notes,
        ]);

        return redirect()->route('client.payment.index')
            ->with('success', 'Payment created! Please complete the payment.');
    }

    // UPDATE STATUS PAYMENT (ADMIN ATAU MANUAL)
    public function updateStatus(Request $request, $id)
    {
        $payment = Payment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,success,failed',
        ]);

        $payment->status = $request->status;
        
        if ($request->status == 'success') {
            $payment->paid_at = now();
        }
        
        $payment->save();

        return back()->with('success', 'Payment status updated!');
    }

    // HAPUS PAYMENT
    public function destroy($id)
    {
        $payment = Payment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $payment->delete();

        return back()->with('success', 'Payment deleted!');
    }
}
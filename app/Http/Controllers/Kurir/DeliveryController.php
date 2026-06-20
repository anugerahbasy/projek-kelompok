<?php

namespace App\Http\Controllers\Kurir;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    // DASHBOARD
    public function dashboard()
    {
        $kurirId = Auth::id();
        
        $data = [
            'totalDeliveries' => Delivery::where('kurir_id', $kurirId)->count(),
            'pendingDeliveries' => Delivery::where('kurir_id', $kurirId)->where('status', 'pending')->count(),
            'onDelivery' => Delivery::where('kurir_id', $kurirId)->where('status', 'on_delivery')->count(),
            'completedDeliveries' => Delivery::where('kurir_id', $kurirId)->where('status', 'completed')->count(),
            'averageRating' => Rating::where('kurir_id', $kurirId)->avg('rating') ?? 0,
            'totalRatings' => Rating::where('kurir_id', $kurirId)->count(),
            'recentRatings' => Rating::where('kurir_id', $kurirId)->with('user')->latest()->take(5)->get(),
        ];
        
        return view('kurir.dashboard', $data);
    }

    // INDEX
    public function index()
    {
        $deliveries = Delivery::where('kurir_id', Auth::id())
            ->with('order.user')
            ->latest()
            ->paginate(10);
            
        return view('kurir.deliveries.index', compact('deliveries'));
    }

    // SHOW
    public function show($id)
    {
        $delivery = Delivery::where('id', $id)
            ->where('kurir_id', Auth::id())
            ->with('order.user', 'order.items.product')
            ->firstOrFail();
            
        $rating = Rating::where('delivery_id', $id)->first();
            
        return view('kurir.deliveries.show', compact('delivery', 'rating'));
    }

    // UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        $delivery = Delivery::where('id', $id)
            ->where('kurir_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'status' => 'required|in:pending,on_delivery,completed,failed',
        ]);

        $delivery->status = $request->status;
        
        if ($request->status == 'completed') {
            $delivery->delivered_at = now();
        }
        
        $delivery->save();

        return redirect()->route('kurir.deliveries.index')
            ->with('success', 'Status pengiriman berhasil diupdate!');
    }
}
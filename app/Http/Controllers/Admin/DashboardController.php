<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // STATISTIK
        $data = [
            'totalUsers' => User::count(),
            'totalKurir' => User::where('role', 'kurir')->count(),
            'totalClient' => User::where('role', 'client')->count(),
            'totalAdmin' => User::where('role', 'admin')->count(),
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            
            // UNTUK GRAFIK
            'adminCount' => User::where('role', 'admin')->count(),
            'kurirCount' => User::where('role', 'kurir')->count(),
            'clientCount' => User::where('role', 'client')->count(),
            
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'processingOrders' => Order::where('status', 'processing')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            'cancelledOrders' => Order::where('status', 'cancelled')->count(),
        ];

        return view('role-dashboards.admin', $data);
    }
}
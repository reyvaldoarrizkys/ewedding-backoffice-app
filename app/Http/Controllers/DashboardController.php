<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClients = Client::count();
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status_pesanan', 'Pending')->count();
        
        $upcomingEvents = Order::with(['client', 'package'])
            ->whereDate('tanggal_acara', '>=', now())
            ->orderBy('tanggal_acara', 'asc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact('totalClients', 'totalOrders', 'pendingOrders', 'upcomingEvents'));
    }
}

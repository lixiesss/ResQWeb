<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Food;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Menghitung statistik untuk ekosistem
        $totalSellers = User::where('role', 'seller')->count();
        $totalCustomers = User::where('role', 'customer')->count();
        
        // Makanan diselamatkan (berdasarkan pesanan yang sudah 'completed')
        $foodRescued = Order::where('status', 'completed')->sum('quantity');
        
        // Estimasi perputaran uang di platform
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Mengambil 10 transaksi terakhir dari seluruh platform
        $recentOrders = Order::with(['food.seller', 'customer'])
                            ->latest()
                            ->limit(10)
                            ->get();

        return view('admin.dashboard', compact(
            'totalSellers', 
            'totalCustomers', 
            'foodRescued', 
            'totalRevenue', 
            'recentOrders'
        ));
    }
}
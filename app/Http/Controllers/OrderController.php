<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Proses pembuatan pesanan
    public function store(Request $request, $food_id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $food = Food::findOrFail($food_id);
        $quantity = $request->quantity;

        // Cek apakah stok mencukupi
        if ($food->stock < $quantity) {
            return back()->with('error', 'Maaf, pesanan gagal. Stok makanan tidak mencukupi.');
        }

        // Gunakan DB Transaction agar data aman. Jika di tengah jalan error, semua dibatalkan (rollback).
        DB::transaction(function () use ($food, $quantity) {
            // 1. Catat Pesanan ke tabel orders
            Order::create([
                'customer_id' => Auth::id(),
                'food_id' => $food->id,
                'quantity' => $quantity,
                'total_price' => $food->discount_price * $quantity,
                'status' => 'pending', // Status pending (menunggu diambil/dibayar di tempat)
            ]);

            // 2. Kurangi stok makanan di tabel foods
            $food->decrement('stock', $quantity);

            // 3. Jika stok habis, ubah status makanan jadi sold_out
            if ($food->stock == 0) {
                $food->update(['status' => 'sold_out']);
            }
        });

        // Arahkan ke halaman riwayat pesanan dengan pesan sukses
        return redirect()->route('order.history')->with('success', 'Yey! Pesanan berhasil dibuat. Silakan ambil di resto sesuai waktu pickup ya.');
    }

    // Menampilkan halaman Riwayat Pesanan untuk Customer
    public function myOrders()
    {
        // Ambil data order beserta relasi makanan dan nama penjualnya
        $orders = Order::with(['food', 'food.seller'])
                    ->where('customer_id', Auth::id())
                    ->latest()
                    ->get();

        return view('customer.orders', compact('orders'));
    }
    // Menampilkan daftar pesanan masuk untuk Seller (Pak Budi)
    public function sellerOrders()
    {
        // Ambil orderan yang makanannya adalah milik seller yang sedang login
        $orders = Order::with(['food', 'customer'])
            ->whereHas('food', function ($query) {
                $query->where('seller_id', Auth::id());
            })
            ->latest()
            ->get();

        return view('seller.orders', compact('orders'));
    }
    // Fungsi untuk menandai pesanan telah selesai/diambil
    public function complete($id)
    {
        $order = Order::with('food')->findOrFail($id);

        // Keamanan: Pastikan yang mengubah adalah pemilik makanan (Pak Budi)
        if ($order->food->seller_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan melakukan aksi ini.');
        }

        $order->update(['status' => 'completed']);

        return back()->with('success', 'Pesanan berhasil diselesaikan. Terima kasih sudah membantu mengurangi food waste!');
    }
}
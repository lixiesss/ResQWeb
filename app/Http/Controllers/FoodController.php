<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    // Menampilkan Dashboard Seller (Daftar Makanan yang dijual)
    public function sellerDashboard()
    {
        // Ambil data makanan yang hanya milik seller yang sedang login
        $foods = Food::where('seller_id', Auth::id())->latest()->get();
        return view('seller.dashboard', compact('foods'));
    }

    // Menampilkan Form Tambah Makanan
    public function create()
    {
        return view('seller.food.create');
    }

    // Menyimpan Data Makanan ke Database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'original_price' => 'required|numeric|min:0',
            'discount_price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:1',
            'pickup_time_start' => 'required|date_format:H:i',
            'pickup_time_end' => 'required|date_format:H:i',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar max 2MB
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('foods', 'public');
        }

        $validated['seller_id'] = Auth::id();
        $validated['status'] = 'available';

        Food::create($validated);

        return redirect()->route('seller.dashboard')->with('success', 'Sisa makanan berhasil diunggah!');
    }
    // Menampilkan Katalog Makanan untuk Customer (Agus)
    public function index()
    {
        // Ambil semua makanan yang stoknya > 0 dan status available
        // 'with('seller')' digunakan untuk memanggil data relasi penjualnya
        $foods = Food::with('seller')
                    ->where('stock', '>', 0)
                    ->where('status', 'available')
                    ->latest()
                    ->get();

        $sellerRatings = Review::selectRaw('target_user_id, target_type, AVG(rating) as avg_rating, COUNT(*) as total_reviews')
            ->whereIn('target_type', ['store', 'supplier'])
            ->whereIn('target_user_id', $foods->pluck('seller_id')->unique())
            ->groupBy('target_user_id', 'target_type')
            ->get()
            ->groupBy('target_user_id');

        foreach ($foods as $food) {
            $ratingGroup = $sellerRatings->get($food->seller_id, collect())->keyBy('target_type');
            $food->store_avg_rating = optional($ratingGroup->get('store'))->avg_rating;
            $food->store_rating_count = optional($ratingGroup->get('store'))->total_reviews ?? 0;
            $food->supplier_avg_rating = optional($ratingGroup->get('supplier'))->avg_rating;
            $food->supplier_rating_count = optional($ratingGroup->get('supplier'))->total_reviews ?? 0;
        }

        return view('customer.katalog', compact('foods'));
    }

    // Menampilkan Profil Toko Publik untuk Customer
    public function storeProfile($id)
    {
        $seller = User::where('role', 'seller')->findOrFail($id);
        
        // Ambil semua makanan yang tersedia di toko ini
        $foods = Food::where('seller_id', $id)
                    ->where('stock', '>', 0)
                    ->where('status', 'available')
                    ->latest()
                    ->get();

        $ratingSummary = Review::selectRaw('target_type, AVG(rating) as avg_rating, COUNT(*) as total_reviews')
            ->where('target_user_id', $id)
            ->whereIn('target_type', ['store', 'supplier'])
            ->groupBy('target_type')
            ->get()
            ->keyBy('target_type');

        return view('customer.store', compact('seller', 'foods', 'ratingSummary'));
    }

    public function destroy($id)
{
    // Cari makanan berdasarkan ID dan pastikan itu milik penjual yang sedang login
    $food = Food::where('id', $id)->where('seller_id', auth()->id())->firstOrFail();
    
    // Hapus file foto jika ada (Opsional tapi disarankan agar storage tidak penuh)
    if ($food->image) {
        \Illuminate\Support\Facades\Storage::disk('public')->delete($food->image);
    }

    $food->delete();

    return redirect()->back()->with('success', 'Menu makanan berhasil dihapus dari katalog!');
}
}

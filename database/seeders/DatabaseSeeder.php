<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::create([
            'name' => 'Admin ResQ',
            'email' => 'admin@resq.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // 2. Buat Akun Seller (Pak Budi)
        $seller = User::create([
            'name' => 'Pak Budi',
            'email' => 'budi@resq.com',
            'password' => Hash::make('password123'),
            'role' => 'seller',
            'store_name' => 'Warung Nasi Pak Budi Ketintang',
            'address' => 'Jl. Ketintang Madya No. 12, Surabaya',
        ]);

        // 3. Buat Akun Customer (Agus)
        $customer = User::create([
            'name' => 'Agus Mahasiswa',
            'email' => 'agus@resq.com',
            'password' => Hash::make('password123'),
            'role' => 'customer',
        ]);

        // 4. Buat Data Makanan Sisa untuk Pak Budi
        $food1 = Food::create([
            'seller_id' => $seller->id,
            'name' => 'Nasi Ayam Penyet Lengkap',
            'description' => 'Nasi, ayam penyet paha, tahu, tempe, sambal bawang mantap. Masih sangat layak, sisa jualan hari ini.',
            'original_price' => 20000,
            'discount_price' => 10000,
            'stock' => 5,
            'pickup_time_start' => '20:00',
            'pickup_time_end' => '22:00',
            'status' => 'available',
        ]);

        Food::create([
            'seller_id' => $seller->id,
            'name' => 'Ayam Bakar Madu (Tanpa Nasi)',
            'description' => 'Ayam bakar madu ukuran besar, sisa stok belum terjual.',
            'original_price' => 15000,
            'discount_price' => 7000,
            'stock' => 3,
            'pickup_time_start' => '21:00',
            'pickup_time_end' => '22:30',
            'status' => 'available',
        ]);

        // 5. Buat Data Dummy Order (Agus memesan Nasi Ayam Penyet Pak Budi)
        Order::create([
            'customer_id' => $customer->id,
            'food_id' => $food1->id,
            'quantity' => 1,
            'total_price' => 10000,
            'status' => 'pending',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Kurangi stok karena sudah dipesan di seeder
        $food1->decrement('stock', 1);
    }
}
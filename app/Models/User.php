<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    // ... (kode bawaan laravel) ...

    // Relasi: Jika user adalah Seller, dia punya banyak makanan
    public function foods()
    {
        return $this->hasMany(Food::class, 'seller_id');
    }

    // Relasi: Jika user adalah Customer, dia punya banyak order
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
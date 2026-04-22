<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'role',
    'store_name',
    'address',
    'accepted_terms_at',
    'accepted_pnc_at',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'accepted_terms_at' => 'datetime',
            'accepted_pnc_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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

    public function receivedReviews()
    {
        return $this->hasMany(Review::class, 'target_user_id');
    }
}

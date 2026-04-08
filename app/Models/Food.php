<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    // Beritahu Laravel secara paksa bahwa nama tabelnya adalah 'foods'
    protected $table = 'foods';

    protected $guarded = [];

    // Makanan ini milik siapa (Seller)
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}
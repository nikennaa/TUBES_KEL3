<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    // Tentukan tabel jika bukan nama default
    protected $table = 'wishlist';

    // Tentukan field yang bisa diisi (fillable)
    protected $fillable = [
        'user_id', 'product_id', 'name', 'description', 'price', 'image'
    ];
}

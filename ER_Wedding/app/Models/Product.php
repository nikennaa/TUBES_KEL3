<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Comment;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function weddingBookings()
{
    return $this->hasMany(WeddingBooking::class);
}


}

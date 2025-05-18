<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class WeddingBooking extends Model
{
    use HasFactory;
    protected $table = 'wedding_bookings';
protected $fillable = [
    'user_id', 'product_id', 'groom_name', 'bride_name',
    'contact_phone', 'contact_email', 'wedding_date', 'wedding_time',
    'venue_name', 'venue_address', 'guest_count', 'estimated_budget',
    'payment_method', 'notes', 'services', 'status'
];


    public function product()
{
    return $this->belongsTo(Product::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}


}

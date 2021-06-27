<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingRoom extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "booking_id", "room_id", "price", "discount", "amount"];

    public function room()
    {
        return $this->belongsTo("App\Models\Room", "room_id", "id");
    }
}

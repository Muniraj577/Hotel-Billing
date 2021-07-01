<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['room_type_id', 'name', 'room_no', 'price', 'is_active', 'status'];

    public function booking_room()
    {
        return $this->belongsTo("App\Models\BookingRoom", "room_id", "id");
    }
}

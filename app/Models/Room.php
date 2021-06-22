<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'room_no', 'is_active', 'status'];

    public function booking_room()
    {
        return $this->belongsTo("App\Models\BookingRoom", "room_id", "id");
    }
}

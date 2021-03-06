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

    public function room_type()
    {
        return $this->belongsTo("App\Models\RoomType", "room_type_id", "id");
    }

    public function orders()
    {
        return $this->hasMany("App\Models\Order", "room_id", "id");
    }

    public function totalAmount()
    {
        return $this->orders->where("status", "Unpaid")->sum("total");
    }
}

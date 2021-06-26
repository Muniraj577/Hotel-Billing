<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "arrival_date", "nepali_arrival_date", "arrival_time", 
        "departure_date", "nepali_departure_date", "departure_time", "no_of_rooms", 
        "no_of_relative", "purpose", "remarks", "status"];

    public function customer()
    {
        return $this->belongsTo("App\Models\Customer", "customer_id", "id");
    }

    public function booking_rooms()
    {
        return $this->hasMany("App\Models\BookingRoom", "booking_id", "id");
    }

    public function relatives()
    {
        return $this->hasMany("App\Models\Customer", "booking_id", "id");
    }
}

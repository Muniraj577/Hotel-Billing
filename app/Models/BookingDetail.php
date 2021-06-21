<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "arrival_date", "nepali_arrival_date", "arrival_time",
        "departure_date", "nepali_departure_date", "departure_time", "no_of_rooms", "purpose", "remarks"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "arrival_date", "nepali_arrival_date", "arrival_time", 
        "departure_date", "nepali_departure_date", "departure_time", "no_of_rooms", 
        "no_of_relative", "purpose", "remarks", "status", "total", "paid", "change_amount", "due"];

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

    public function customers()
    {
        return $this->hasMany("App\Models\Relative", "booking_id", "id");
    }

    public function payments()
    {
        return $this->hasMany("App\Models\Payment", "booking_id", "id");
    }

    public function totalPaid()
    {
        return $this->payments->sum("paid");
    }

    public function totalDue()
    {
        return $this->payments->sum("due");
    }

    public function lastDue()
    {
        return $this->payments()->latest()->first()->due;
    }

    public function totalPrice()
    {
        return $this->booking_rooms->sum("amount");
    }
}

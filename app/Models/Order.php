<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["booking_id", "room_id", "customer_id", "total", "paid", "due", "change_amount"];

    public function booking()
    {
        return $this->belongsTo("App\Models\Booking", "booking_id", "id");
    }

    public function room()
    {
        return $this->belongsTo("App\Models\Room", "room_id", "id");
    }

    public function customer()
    {
        return $this->belongsTo("App\Models\Customer", "customer_id", "id");
    }
}

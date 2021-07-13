<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use HasFactory;

    protected $fillable = ["order_id", "room_id", "booking_id", "customer_id", "paid", "due", "date", "pay_type"];

    public function order()
    {
        return $this->belongsTo("App\Models\Order", "order_id", "id");
    }
}

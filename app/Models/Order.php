<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ["booking_id", "room_id", "customer_id", "total", "paid", "due", "change_amount", "status"];

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

    public function order_items()
    {
        return $this->hasMany("App\Models\OrderItem", "order_id", "id");
    }

    public function payments()
    {
        return $this->hasMany("App\Models\OrderPayment", "order_id", "id");
    }

    public function totalPaid()
    {
        $paid_1 = $this->payments->where("pay_type", "Unpaid")->sum("paid");
        $paid_2 = $this->payments->where("pay_type", "Partially Paid")->sum("paid");
        return $paid_1 + $paid_2;
    }

    public function totalDue()
    {
        // dd($this->payments);
        $due_1 =  $this->payments->where("pay_type", "Unpaid")->sum("due");
        $due_2 = $this->payments->where("pay_type", "Partially Paid")->sum("due");
    
        return $due_1 + $due_2;
    }
}

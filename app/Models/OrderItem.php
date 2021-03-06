<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ["order_id", "product_id", "unit_id", "price", "qty", "discount", "amount"];

    public function order()
    {
        return $this->belongsTo("App\Models\Order", "order_id", "id");
    }

    public function product()
    {
        return $this->belongsTo("App\Models\Product", "product_id", "id");
    }

    public function unit()
    {
        return $this->belongsTo("App\Models\Unit", "unit_id", "id");
    }
}

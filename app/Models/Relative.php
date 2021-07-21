<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    protected $fillable = ["customer_id", "booking_id", "first_name", "middle_name", "last_name", 
    "gender", "age", "contact_no", "relation"];


    public function customer()
    {
        return $this->belongsTo("App\Models\Customer", "customer_id", "id");
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->middle_name) . " ". ucfirst($this->last_name);
    }

    protected $appends = ["full_name"];
}

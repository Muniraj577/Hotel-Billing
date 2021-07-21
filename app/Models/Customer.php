<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ["parent_id", "booking_id", "first_name", "middle_name", "last_name", "gender", "age", "nationality",
        "address", "contact_no", "occupation", "identity_no", "driving_license_no", "signature", "profile_pic", "relation"];

    public function booking_details()
    {
        return $this->hasMany("App\Models\BookingDetail", "customer_id", "id");
    }

    public static function getCustomer($keyword)
    {
        return self::where("parent_id",null)->where('first_name', "LIKE", "%". $keyword . "%")->orWhere('contact_no', $keyword)->get();
    }
    
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->middle_name) . " ". ucfirst($this->last_name);
    }

    public function getSign($sign)
    {
        if($sign != null){
            return asset("images/customers/signature/".$sign);
        }
    }

    public function getAvatar($avatar = "default.png")
    {
        return asset("images/customers/profile/".$avatar);
    }

    public function orders()
    {
        return $this->hasMany("App\Models\Order", "customer_id", "id");
    }

    public function totalAmount()
    {
        return $this->orders->where("status", "Unpaid")->sum("total");
    }

    protected $appends = ["full_name"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ["first_name", "middle_name", "last_name", "gender", "age", "nationality",
        "address", "contact_no", "occupation", "identity_no", "driving_license_no", "signature"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    use HasFactory;

    protected $fillable = ["name", "slug", "status"];

    public function customer()
    {
        return $this->belongsTo("App\Models\Customer", "identity_id", "id");
    }
}

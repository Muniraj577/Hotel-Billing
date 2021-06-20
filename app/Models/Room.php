<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'room_no', 'is_active', 'status'];

    // public function room_status()
    // {
    //     return [
    //         "Available", "UnAvailable"
    //     ];
    // }
}

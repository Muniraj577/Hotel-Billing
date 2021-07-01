<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = ["name", "status"];

    public function rooms()
    {
        return $this->hasMany("App\Models\Room", "room_type_id", "id");
    }
}

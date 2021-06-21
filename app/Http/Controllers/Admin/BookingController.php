<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Room;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $page = "admin.booking.";
    private $redirectTo = "admin.booking.index";
    public function index()
    {
        return view($this->page.'index')->with("id");
    }

    public function create()
    {
        $rooms = Room::where("is_active", 1)->where("status", "Available")->get();
        return view($this->page."create", compact("rooms"));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Order;
use App\Models\Product;
use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy("id", "desc")->get();
        return view($this->page."index",compact("orders"))->with("id");
    }

    public function create()
    {
        $booking_details = BookingDetail::where("status", 1)->get();

        foreach($booking_details as $bkd){
            $bkd_ids[] = $bkd->id;
        }
        $booking_rooms = BookingRoom::whereIn("booking_id", $bkd_ids)->get();
        foreach($booking_rooms as $booking_room){
            $room_ids[] = $booking_room->id;
        }
        $rooms = Room::whereIn("id", (array)$room_ids)->get();
        $products = Product::all();
        return view($this->page."create", compact("rooms", "products"));
    }
    private $page = "admin.order.";
    private $redirectTo = "admin.order.index";
}

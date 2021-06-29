<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Room;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getCustomer(Request $request)
    {
        return Customer::getCustomer($request->keyword);
    }

    public function getRoomPrice(Request $request)
    {
        $price = Room::where("id", $request->room_id)->pluck("price");
        return $price;
    }

    public function getRoomCustomer(Request $request)
    {
        $bkroom = BookingRoom::where("room_id", $request->room_id)->orderBy("id", "desc")->first();
        $customers = Customer::where("id", $bkroom->customer_id)->orWhere("parent_id", $bkroom->customer_id)->select("id", "first_name", "middle_name", "last_name")->get();
        return response()->json(["booking_id"=>$bkroom->booking_id, "customers" => $customers]); 
    }

    public function getProductDetails(Request $request)
    {
        $product = Product::where("id", $request->product_id)->first();
        return $product;
    }
}

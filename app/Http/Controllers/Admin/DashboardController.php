<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $room_types = RoomType::all();
        return view('admin.dashboard',compact("room_types"));
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
        $unit = Unit::where("id", $product->unit_id)->first()->name;
        return response()->json(["product" => $product, "unit"=>$unit]);
    }

    public function getProducts(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->input('product_name') . '%')->get();
        return $products;
    }

    public function getCustomerDetails(Request $request)
    {
        $bkroom = BookingRoom::where("room_id", $request->room_id)->orderBy("id", "desc")->first();
        $bkdetail = BookingDetail::where("id", $bkroom->booking_id)->where("status", 1)->orderBy("id", "desc")->first();
        return view("admin.partial.customer.detail", compact("bkroom", "bkdetail"));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
}

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
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $room_types = RoomType::all();
        $totalRoom = Room::count();
        $totalCustomer = Customer::count();
        $activeBook = BookingDetail::where("status", 1)->count();
        $inactiveBook = BookingDetail::where("status", 0)->count();
        $available_room = Room::where("status", "Available")->count();
        $unavailable_room = Room::where("status", "UnAvailable")->count();
        return view('admin.dashboard', compact("room_types", "totalRoom", "totalCustomer",
            "activeBook", "inactiveBook", "available_room", "unavailable_room"));
    }

    public function chartData()
    {
        $totalRoom = Room::count();
        $totalCustomer = Customer::count();
        $activeBook = BookingDetail::where("status", 1)->count();
        $inactiveBook = BookingDetail::where("status", 0)->count();
        $available_room = Room::where("status", "Available")->count();
        $unavailable_room = Room::where("status", "UnAvailable")->count();
        $count_data = [
            "Total Room" => $totalRoom,
            "Total Customer" => $totalCustomer,
            "Active Booking" => $activeBook,
            "Inactive Booking" => $inactiveBook,
            "Available Room" => $available_room,
            "Unavailable Room" => $unavailable_room,
        ];
        return response()->json($count_data);
    }

    public function getBooking()
    {
        /** Working Code Made it
        $data = BookingDetail::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTH(created_at) as month"))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get()->toArray();
        $datamcount = [];
        $dataArr = [];
        foreach ($data as $key => $value) {
            $datamcount[$value['month']]=$value['count'];
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($datamcount[$i])) {
                $dataArr[$i] = $datamcount[$i];
            } else {
                $dataArr[$i] = 0;
            }
        }
        return response()->json($dataArr);
         **/
        // Get Monthly Data Report
        $bookings = BookingDetail::select("id", "created_at")->whereYear("created_at", date('Y'))->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('m');
            });
        $bookingmcount = [];
        $bookArr = [];
        foreach ($bookings as $key => $value) {
            $bookingmcount[(int) $key] = count($value);
        }
        for ($i = 1; $i <= 12; $i++) {
            if (!empty($bookingmcount[$i])) {
                $bookArr[$i] = $bookingmcount[$i];
            } else {
                $bookArr[$i] = 0;
            }
        }
        return response()->json($bookArr);
    }

    public function getMonthlyDayBooking()
    {
        $bookings = BookingDetail::select([
            DB::raw('DATE(arrival_date) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])->whereBetween('arrival_date', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('arrival_date')
            ->orderBy('arrival_date', 'ASC')
            ->get()
            ->toArray();
        $lastThirtyDays = CarbonPeriod::create(Carbon::now()->subDays(29), Carbon::now());
        $dateCount = array();
        foreach ($lastThirtyDays as $date) {
            $dateCount[$date->format("Y-m-d")] = 0;
        }

        foreach ($bookings as $countPerDay) {
            $dateCount[$countPerDay['date']] = $countPerDay['count'];
        }
        return response()->json($dateCount);
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
        return response()->json(["booking_id" => $bkroom->booking_id, "customers" => $customers]);
    }

    public function getProductDetails(Request $request)
    {
        $product = Product::where("id", $request->product_id)->first();
        $unit = Unit::where("id", $product->unit_id)->first()->name;
        return response()->json(["product" => $product, "unit" => $unit]);
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

    public function getCustomerPrice(Request $request)
    {
        $customer = Customer::where("id", $request->customer_id)->firstOrFail();
    }
}

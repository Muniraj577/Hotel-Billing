<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Room;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = $this->validation($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $order = new Order();
                $order->booking_id = $request->booking_id;
                $order->room_id = $request->room_id;
                $order->customer_id = $request->customer_id;
                $order->total = $request->total;
                $order->paid = $request->paid;
                $order->due = $request->due;
                $order->save();
                $this->__createOrderItems($request, $order->id);
                DB::commit();
                return redirect()->back()->with(notify("success", "Order created successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    private function __createOrderItems($data, $orderId)
    {
        foreach($data->input("product_id") as $key=>$value){
            $order_item = new OrderItem();
            $order_item->order_id = $orderId;
            $order_item->product_id = $value;
            $order_item->unit_id = $data->get("unit_id")[$key];
            $order_item->price = $data->get("price")[$key];
            $order_item->qty = $data->get("qty")[$key];
            $order_item->discount = $data->get("discount")[$key];
            $order_item->amount = $data->get("amount")[$key];
            $order_item->save();
        }
    }

    private function validation(array $data)
    {
        $validator = Validator::make($data,[
            "room_id" => "required",
            "customer_id" => "required",
            "product_id.*" => "required",
            "unit_id.*" => "required",
            "price.*" => "required|numeric",
            "qty.*" => "required|numeric",
            "discount.*" => "nullable|numeric",
            "amount.*" => "required|numeric",
            "total" => "required|numeric",
            "due" => "required|numeric",
        ], $this->messages());
        return $validator;
    }

    private function messages()
    {
        return [
            "room_id.required" => "Select Room",
            "customer_id.required" => "Select Customer",
            "product_id.*.required" => "Product is required",
            "unit_id.*.required" => "Unit is required",
            "price.*.required" => "Price is required",
            "price.*.numeric" => "Please enter valid price",
            "qty.*.required" => "Qty is required",
            "qty.*.numeric" => "Please enter valid qty",
            "discount.*.numeric" => "Please enter valid discount",
            "amount.*.required" => "Amount is required",
            "amount.*.numeric" => "Please enter valid amount",
            "total.required" => "Total is required",
            "total.numeric" => "Total must have valid amount",
            "due.required" => "Due is required",
            "due.numeric" => "Due must have valid due amount",
        ];
    }

    private $page = "admin.order.";
    private $redirectTo = "admin.order.index";
}

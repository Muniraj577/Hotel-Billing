<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function markpaid(Request $request)
    {
        // dd($request->all());
        try{
            DB::beginTransaction();
            $order_payment = new OrderPayment();
            $order_payment->paid = $request->paid;
            $order_payment->due = 0;
            $order_payment->room_id = $request->room_id;
            $order_payment->save();
            $orders = Order::where("room_id", $request->room_id)->get();
            foreach($orders as $order){
                $order->update(["status"=>"Paid"]);
            }
            DB::commit();
            return redirect()->back()->with(notify("success", "Order payment created successfully"));
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
        }
    }
}

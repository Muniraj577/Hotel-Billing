<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function create($id)
    {
        $booking_detail = BookingDetail::where("id", $id)->firstOrFail();
        return view($this->page."create", compact("booking_detail"));
    }   

    public function store(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "date" => "required",
            "payment_type" => "required",
            "add_payment" => ["required_if:payment_type,Partial Payment", "numeric"],
            "due" => "required|numeric",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $payment = new Payment();
                $payment->booking_id = $id;
                if($request->payment_type == "Full Payment"){
                    $payment->paid = $request->last_due;
                    $payment->due = 0;
                    $payment->type = "Paid";
                } else if($request->payment_type == "Partial Payment"){
                    $payment->paid = $request->add_payment;
                    $payment->due = $request->due;
                    $payment->type = "Partially Paid";
                }
                $payment->date = $request->date;
                $payment->save();
                DB::commit();
                return redirect()->route("admin.booking.index")->with(notify("success", "Payment created successfully"));
            }catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }

    }



    private $page = "admin.booking.payment.";
}

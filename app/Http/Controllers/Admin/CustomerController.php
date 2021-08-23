<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy("id", "desc")->get();
        return view("admin.customer.index",compact("customers"))->with("id");
    }

    public function show($id)
    {
        $customer = Customer::where("id", $id)->with("booking_details")->firstOrFail();
        return view("admin.customer.show", compact("customer"))->with("id");
    }

    public function booking_detail($id)
    {
        $customer = Customer::where("id", $id)->with("booking_details")->firstOrFail();
        return view($this->page."booking_details",compact("customer"))->with("id");
    }

    private $page = "admin.customer.";
}

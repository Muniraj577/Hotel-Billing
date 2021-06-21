<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    private $page = "admin.booking.";
    private $redirectTo = "admin.booking.index";
    public function index()
    {
        return view($this->page . 'index')->with("id");
    }

    public function create()
    {
        $rooms = Room::where("is_active", 1)->where("status", "Available")->get();
        return view($this->page . "create", compact("rooms"));
    }

    public function store(Request $request)
    {
        dd($request->all());
        $validator = $this->validation($request->all());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                return redirect()->back()->with(notify("succes", "Booking created successfully"));
            } catch(\Exception $e){
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    private function validation(array $data)
    {
        return Validator::make($data, [
            "first_name" => "required",
            "last_name" => "required",
            "gender" => "required",
            "age" => "required|integer|max:100",
            "nationality" => "required",
            "address" => "required",
            "contact_no" => "required",
            "occupation" => "required",
            "identity_no" => "required",
            "signature" => "image|mimes:jpeg,jpg,png|max:2048",
            "arrival_date" => "required",
            "arrival_time" => "required",
            "no_of_rooms" => "required|integer",
            "room_no.*" => "required",
        ],$this->messages());
    }

    private function messages()
    {
        return [
            "first_name.required" => "First Name is required",
            "last_name.required" => "Surname is required",
            "gender.required" => "Gender is required",
            "age.required" => "Age is required",
            "age.integer" => "Age must be a number",
            "age.max" => "Age must be between 0 and 100",
            "nationality.required" => "Nationality is required",
            "address.required" => "Address is required",
            "contact_no.required" => "Contact number is required",
            "occupation.required" => "Occupation is required",
            "identity_no.required" => "Citizenship number is required",
            "signature.image" => "Please upload a valid image",
            "signature.mimes" => "Image must be of type jpg, jpeg, png",
            "arrival_date.required" => "Arrival date is required",
            "arrival_time.required" => "Arrival time is required",
            "room_no.*.required" => "Please select room",
            "no_of_rooms.required" => "Please enter no. of rooms",
            "no_of_rooms.integer" => "This field must be number",
        ];
    }
}

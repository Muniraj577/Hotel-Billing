<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Customer;
use App\Models\Room;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    private $page = "admin.booking.";
    private $destination = 'images/customers/signature/';
    private $redirectTo = "admin.booking.index";
    public function index()
    {
        $booking_details = BookingDetail::with("customer")->orderBy("id", "desc")->get();
        return view($this->page . 'index', compact("booking_details"))->with("id");
    }

    public function create()
    {
        $rooms = Room::where("is_active", 1)->where("status", "Available")->get();
        return view($this->page . "create", compact("rooms"));
    }

    public function store(Request $request)
    {
        $validator = $this->validation($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $client = Customer::find($request->customer_id);
                if ($client != null) {
                    $oldImage = $client->signature;
                    if ($request->hasFile('signature')) {
                        $image = Upload::image($request, 'signature', $this->destination, $oldImage);
                    } else {
                        $image = $oldImage;
                    }
                } else {
                    if ($request->hasFile('signature')) {
                        $image = Upload::image($request, 'signature', $this->destination, null);
                    } else {
                        $image = '';
                    }
                }

                $customer = Customer::updateOrCreate([
                    'id' => $request->customer_id,
                ], [
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'age' => $request->age,
                    'nationality' => $request->nationality,
                    'address' => $request->address,
                    'contact_no' => $request->contact_no,
                    'occupation' => $request->occupation,
                    'identity_no' => $request->identity_no,
                    'driving_license_no' => $request->driving_license_no,
                    'signature' => $image,
                ]);
                $this->__createBooking($request, $customer->id);
                DB::commit();
                return redirect()->back()->with(notify("success", "Booking created successfully"));
            } catch (\Exception $e) {
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function show($id)
    {
        $booking_detail = BookingDetail::where("id", $id)->with("customer")->with("booking_rooms")->firstOrFail();
        return view($this->page . "show", compact("booking_detail"));
    }

    public function getDepartureModel($id)
    {
        $booking_detail = BookingDetail::findOrFail($id);
        return view("admin.partial.booking.updatedeparture", compact("booking_detail"));
    }

    public function updateDeparture(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "departure_date" => "required",
            "departure_time" => "required",
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $booking = BookingDetail::find($id);
                $booking->update([
                    "departure_date" => $request->departure_date,
                    "nepali_departure_date" => $request->nepali_departure_date,
                    "departure_time" => $request->departure_time,
                ]);
                date_default_timezone_set("Asia/Kathmandu");
                $a = date("y-m-d H:i");
                $b = $request->departure_date . " ". $request->departure_time;
                if(strtotime($a) > strtotime($b)){
                    foreach($booking->booking_rooms as $booking_room){
                        $room = Room::where('id', $booking_room->room_id)->first();
                        $room->update(['status' => 'Available']);
                    }
                }
                DB::commit();
                date_default_timezone_set("UTC");
                return 200;
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json($e->getMessage());
            }
        }
    }

    private function __createBooking($data, $customerId)
    {
        $bkd = BookingDetail::create([
            'customer_id' => $customerId,
            'arrival_date' => $data->arrival_date,
            'nepali_arrival_date' => $data->nepali_arrival_date,
            'arrival_time' => $data->arrival_time,
            'departure_date' => $data->departure_date,
            'nepali_departure_date' => $data->nepali_departure_date,
            'departure_time' => $data->departure_time,
            'purpose' => $data->purpose,
            'remarks' => $data->remarks,
            'no_of_rooms' => $data->no_of_rooms,
        ]);
        $this->__createRoomDetail($data, $customerId, $bkd->id);
    }

    private function __createRoomDetail($data, $customerId, $booking_id)
    {
        foreach ($data->input('room_no') as $key => $value) {
            $rd = BookingRoom::create([
                'customer_id' => $customerId,
                'booking_id' => $booking_id,
                'room_id' => $value,
            ]);
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
        ], $this->messages());
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

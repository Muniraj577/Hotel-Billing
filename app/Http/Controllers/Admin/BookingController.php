<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Customer;
use App\Models\Relative;
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
        $countRoom = Room::where("is_active",1)->where("status", "Available")->count();
        return view($this->page . "create", compact("rooms", "countRoom"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
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
                $bkd = BookingDetail::create([
                    'customer_id' => $customer->id,
                    'arrival_date' => $request->arrival_date,
                    'nepali_arrival_date' => $request->nepali_arrival_date,
                    'arrival_time' => date("H:i", strtotime($request->arrival_time)),
                    'departure_date' => $request->departure_date,
                    'nepali_departure_date' => $request->nepali_departure_date,
                    'departure_time' => $request->departure_time != null ? date("H:i", strtotime($request->departure_time)) : null,
                    'purpose' => $request->purpose,
                    'remarks' => $request->remarks,
                    'no_of_rooms' => $request->no_of_rooms,
                    'no_of_relative' => $request->no_of_relatives,
                ]);
                $this->__createRoomDetail($request, $customer->id, $bkd->id);
                DB::commit();
                if ($request->save == "save") {
                    return redirect()->back()->with(notify("success", "Booking created successfully"));
                } else if ($request->save == "save_and_add_relative") {
                    return redirect()->route("admin.relative.create", $bkd->id)->with(notify("success", "Booking created successfully"));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function show($id)
    {
        $booking_detail = BookingDetail::where("id", $id)->with("customer")->with("booking_rooms")->firstOrFail();
        return view($this->page . "show", compact("booking_detail"));
    }

    public function edit($id)
    {
        $booking_detail = BookingDetail::where("id", $id)->with("customer")->firstOrFail();
        return view($this->page . "edit", compact("booking_detail"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "first_name" => "required|string",
            "last_name" => "required|string",
            "gender" => "required|string",
            "age" => "required|integer|max:100",
            "nationality" => "required|string",
            "address" => "required",
            "contact_no" => "required",
            "occupation" => "required|string",
            "identity_no" => "required",
            "signature" => "image|mimes:jpeg,jpg,png|max:2048",
            "arrival_date" => "required",
            "arrival_time" => "required",
        ],[
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
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $booking_detail = BookingDetail::findOrFail($id);
                if ($request->customer_id != null) {
                    $this->__updateCustomer($request, $request->customer_id, $booking_detail->id);
                    $booking_rooms = BookingRoom::where("booking_id", $id)->get();
                    $customers = Customer::where("booking_id", $id)->get();
                    foreach ($booking_rooms as $booking_room) {
                        $booking_room->update(["customer_id" => $request->customer_id]);
                    }
                    foreach ($customers as $customer) {
                        $customer->update(["parent_id" => $request->customer_id]);
                    }
                    
                } else if ($request->customer_id == null) {
                    $this->__updateCustomer($request, $booking_detail->customer_id, $booking_detail->id);
                }

                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Booking detail updated successfully"));
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage));
            }
        }
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
                    "departure_time" => $request->departure_time != null ? date("H:i", strtotime($request->departure_time)) : null,
                ]);
                date_default_timezone_set("Asia/Kathmandu");
                $a = date("y-m-d H:i");
                $b = $request->departure_date . " " . $request->departure_time;
                if (strtotime($a) > strtotime($b)) {
                    foreach ($booking->booking_rooms as $booking_room) {
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
            'arrival_time' => date("H:i", strtotime($data->arrival_time)),
            'departure_date' => $data->departure_date,
            'nepali_departure_date' => $data->nepali_departure_date,
            'departure_time' => $data->departure_time != null ? date("H:i", strtotime($data->departure_time)) : null,
            'purpose' => $data->purpose,
            'remarks' => $data->remarks,
            'no_of_rooms' => $data->no_of_rooms,
            'no_of_relative' => $data->no_of_relatives,
        ]);
        $this->__createRoomDetail($data, $customerId, $bkd->id);
        if ($data->no_of_relatives != null || $data->no_of_relatives > 0) {
            $this->__createRelative($data, $customerId, $bkd->id);
        }
        if ($data->save == "save") {
            return redirect()->back()->with(notify("success", "Booking created successfully"));
        } else if ($data->save == "save_and_add_relative") {
            return redirect()->route("admin.relative.create", $bkd->id)->with(notify("success", "Booking created successfully"));
        }

    }

    private function __createRoomDetail($data, $customerId, $booking_id)
    {
        foreach ($data->input('room_no') as $key => $value) {
            $rd = BookingRoom::create([
                'customer_id' => $customerId,
                'booking_id' => $booking_id,
                'room_id' => $value,
            ]);
            $room = Room::where("id", $value)->firstOrFail();
            $room->update(["status" => "UnAvailable"]);
        }

    }

    private function __updateCustomer($data, $customerId, $booking_id)
    {
        $customer = Customer::where("id", $customerId)->firstOrFail();
        $oldSign = $customer->signature;
        $customer->first_name = $data->first_name;
        $customer->middle_name = $data->middle_name;
        $customer->last_name = $data->last_name;
        $customer->gender = $data->gender;
        $customer->age = $data->age;
        $customer->nationality = $data->nationality;
        $customer->address = $data->address;
        $customer->contact_no = $data->contact_no;
        $customer->occupation = $data->occupation;
        $customer->identity_no = $data->identity_no;
        $customer->driving_license_no = $data->driving_license_no;
        if ($data->has("signature")) {
            $customer->signature = Upload::image($data, "signature", $this->destination, $oldSign);
        } else {
            $customer->signature = $oldSign;
        }
        $customer->save();
        $booking_detail = BookingDetail::findOrFail($booking_id);
        $booking_detail->update([
            'customer_id' => $customerId,
            'arrival_date' => $data->arrival_date,
            'nepali_arrival_date' => $data->nepali_arrival_date,
            'arrival_time' => date("H:i", strtotime($data->arrival_time)),
            'departure_date' => $data->departure_date,
            'nepali_departure_date' => $data->nepali_departure_date,
            'departure_time' => $data->departure_time != null ? date("H:i", strtotime($data->departure_time)) : null,
            'purpose' => $data->purpose,
            'remarks' => $data->remarks,
        ]);
    }

    private function __createRelative($data, $customerId, $booking_id)
    {
        foreach ($data->input("relative_first_name") as $key => $value) {
            $relative = Relative::create([
                'customer_id' => $customerId,
                'booking_id' => $booking_id,
                'first_name' => $value,
                'middle_name' => $data->get('relative_middle_name')[$key],
                'last_name' => $data->get('relative_last_name')[$key],
                'gender' => $data->get('relative_gender')[$key],
                'age' => $data->get('relative_age')[$key],
                'contact_no' => $data->get('relative_contact_no')[$key],
                'relation' => $data->get('relative_relation')[$key],
            ]);
        }
    }

    private function validation(array $data)
    {
        return Validator::make($data, [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "gender" => "required|string",
            "age" => "required|integer|max:100",
            "nationality" => "required|string",
            "address" => "required",
            "contact_no" => "required",
            "occupation" => "required|string",
            "identity_no" => "required",
            "signature" => "image|mimes:jpeg,jpg,png|max:2048",
            "arrival_date" => "required",
            "arrival_time" => "required",
            "no_of_rooms" => "required|integer",
            "room_no.*" => "required",
            "relative_first_name.*" => "required_with:no_of_relatives|string",
            "relative_last_name.*" => "required_with:no_of_relatives|string",
            "relative_age.*" => "required_with:no_of_relatives|numeric",
            "relative_relation.*" => "required_with:no_of_relatives|string",
            "relative_gender.*" => "required_with:no_of_relatives|string",
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
            "relative_first_name.required_with" => "This field is required",
            "relative_last_name.required_with" => "This field is required",
            "relative_age.required_with" => "This field is required",
            "relative_relation.required_with" => "This field is required",
        ];
    }
}

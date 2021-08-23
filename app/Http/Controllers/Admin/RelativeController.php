<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Customer;
use App\Models\Identification;
use App\Models\Relative;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RelativeController extends Controller
{
    public function create($id)
    {
        $booking_detail = BookingDetail::findOrFail($id);
        $identities = Identification::all();
        return view($this->page . "create", compact("booking_detail", "identities"));
    }

    public function store(Request $request, $id)
    {
        $validator = $this->validation($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $bkd = BookingDetail::findOrFail($id);
                $client = Customer::find($request->customer_id);
                if ($client != null) {
                    $oldImage = $client->signature;
                    $oldProfile = $client->profile_pic;
                    if ($request->hasFile('signature')) {
                        $image = Upload::image($request, 'signature', $this->destination, $oldImage);
                    } else {
                        $image = $oldImage;
                    }
                    if ($request->hasFile("profile_pic")) {
                        $profile = Upload::image($request, "profile_pic", $this->prfdest, $oldProfile);
                    } else {
                        $profile = $oldProfile;
                    }
                } else {
                    if ($request->hasFile('signature')) {
                        $image = Upload::image($request, 'signature', $this->destination, null);
                    } else {
                        $image = '';
                    }
                    if ($request->hasFile("profile_pic")) {
                        $profile = Upload::image($request, "profile_pic", $this->prfdest, null);
                    } else {
                        $profile = '';
                    }
                }
                $customer = Customer::updateOrCreate([
                    'id' => $request->customer_id,
                ], [
                    'identity_id' => $request->identity_id,
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
                    'profile_pic' => $profile,
                    'parent_id' => $bkd->customer_id,
                    'booking_id' => $id,
                    'relation' => $request->relation,
                ]);
                $relative = new Relative();
                $relative->customer_id = $customer->id;
                $relative->booking_id = $id;
                $relative->relation = $request->relation;
                $relative->save();
                DB::commit();
                if ($request->save == "save") {
                    return redirect()->route("admin.booking.show", $id)->with(notify("success", "Relative created successfully"));
                } else if ($request->save == "save_and_continue") {
                    return redirect()->back()->with(notify("success", "Relative added."));
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function edit($id)
    {
        $relative = Relative::findOrFail($id);
        $customer = Customer::where("id", $relative->customer_id)->first();
        $identities = Identification::all();
        // $customer = Customer::findOrFail($id);
        return view($this->page . "edit", compact("customer", "relative", "identities"));
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validation($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $relative = Relative::findOrFail($id);
                $client = Customer::find($request->customer_id);
                if($client != null){
                    $this->__updateCustomer($request, $request->customer_id);
                    $relative->update([
                        "customer_id" => $request->customer_id,
                        "relation" => $request->relation,
                    ]);
                } else {
                    $customer_id = Customer::where("id", $relative->customer_id)->first()->id;
                    $this->__updateCustomer($request, $customer_id);
                    $relative->update([
                        "customer_id" => $customer_id,
                        "relation" => $request->relation,
                    ]);
                }
                DB::commit();
                return redirect()->route("admin.booking.show", $relative->booking_id)->with(notify("success", "Relative updated successfully"));
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        // $relative = Relative::findOrFail($id);
        // $bkd = BookingDetail::where("id", $relative->booking_id)->first();
        // $no_of_relative = $bkd->no_of_relative;
        // $bkd->update([
        //     "no_of_relative" => $no_of_relative - 1,
        // ]);
        // $relative->delete();
        try {
            DB::beginTransaction();
            // $customer = Customer::findOrFail($id);
            // FileUnlink($this->prfdest, $customer->profile_pic);
            // FileUnlink($this->destination, $customer->signature);
            // $customer->delete();
            $relative = Relative::findOrFail($id);
            $relative->delete();
            DB::commit();
            return redirect()->back()->with(notify("success", "Relative deleted successfully"));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
        }

    }

    private function __updateCustomer($data, $customer_id)
    {
        $customer = Customer::find($customer_id);
        $oldSign = $customer->signature;
        $oldPic = $customer->profile_pic;
        $customer->identity_id = $data->identity_id;
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
        if ($data->hasFile("signature")) {
            $customer->signature = Upload::image($data, "signature", $this->destination, $oldSign);
        } else {
            $customer->signature = $oldSign;
        }
        if ($data->hasFile("profile_pic")) {
            $customer->profile_pic = Upload::image($data, "profile_pic", $this->prfdest, $oldPic);
        } else {
            $customer->profile_pic = $oldPic;
        }
        $customer->relation = $data->relation;
        $customer->save();
    }

    private function validation(array $data)
    {
        return Validator::make($data, [
            "identity_id" => "required",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "gender" => "required|string",
            "age" => "required|integer|max:100",
            "nationality" => "required|string",
            "address" => "required",
            "contact_no" => "required|numeric|digits_between:10,13",
            "occupation" => "required|string",
            "identity_no" => "required",
            "signature" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
            "profile_pic" => "nullable|image|mimes:jpeg,jpg,png|max:2048",
            "relation" => "required|string",
        ], $this->messages());
    }

    private function messages()
    {
        return [
            "identity_id.required" => "Identity Type is required",
            "first_name.required" => "First Name is required",
            "last_name.required" => "Surname is required",
            "gender.required" => "Gender is required",
            "age.required" => "Age is required",
            "age.integer" => "Age must be a number",
            "age.max" => "Age must be between 0 and 100",
            "nationality.required" => "Nationality is required",
            "address.required" => "Address is required",
            "contact_no.required" => "Contact number is required",
            "contact_no.min" => "Contact number must have at least 10 digits",
            "contact_no.numeric" => "Contact number must contain only numeric value",
            "contact_no.digits_between" => "The Contact number length must be 10 to 13",
            "occupation.required" => "Occupation is required",
            "identity_no.required" => "Identity number is required",
            "signature.image" => "Please upload a valid image",
            "signature.mimes" => "Image must be of type jpg, jpeg, png",
            "profile_pic.image" => "Please upload a valid image",
            "profile_pic.mimes" => "Image must be of type jpg, jpeg, png",
            "relation.required" => "Relation field is required",
        ];
    }

    private $page = "admin.relative.";
    private $destination = "images/customers/signature/";
    private $prfdest = "images/customers/profile/";
}

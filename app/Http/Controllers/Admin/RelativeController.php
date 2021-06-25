<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Customer;
use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RelativeController extends Controller
{
    public function create($id)
    {
        $booking_detail = BookingDetail::findOrFail($id);
        return view($this->page . "create", compact("booking_detail"));
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
                $customer = new Customer();
                $customer->first_name = $request->first_name;
                $customer->middle_name = $request->middle_name;
                $customer->last_name = $request->last_name;
                $customer->gender = $request->gender;
                $customer->age = $request->age;
                $customer->nationality = $request->nationality;
                $customer->address = $request->address;
                $customer->contact_no = $request->contact_no;
                $customer->occupation = $request->occupation;
                $customer->identity_no = $request->identity_no;
                $customer->driving_license_no = $request->driving_license_no;
                if ($request->hasFile("signature")) {
                    $customer->signature = Upload::image($request, "signature", $this->destination, null);
                }
                if ($request->hasFile("profile_pic")) {
                    $customer->profile_pic = Upload::image($request, "profile_pic", $this->prfdest, null);
                }
                $customer->parent_id = $bkd->customer_id;
                $customer->booking_id = $id;
                $customer->relation = $request->relation;
                $customer->save();
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
        $customer = Customer::findOrFail($id);
        return view($this->page . "edit", compact("customer"));
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
                $customer = Customer::find($id);
                $oldSign = $customer->signature;
                $oldPic = $customer->profile_pic;
                $customer->first_name = $request->first_name;
                $customer->middle_name = $request->middle_name;
                $customer->last_name = $request->last_name;
                $customer->gender = $request->gender;
                $customer->age = $request->age;
                $customer->nationality = $request->nationality;
                $customer->address = $request->address;
                $customer->contact_no = $request->contact_no;
                $customer->occupation = $request->occupation;
                $customer->identity_no = $request->identity_no;
                $customer->driving_license_no = $request->driving_license_no;
                if ($request->hasFile("signature")) {
                    $customer->signature = Upload::image($request, "signature", $this->destination, $oldSign);
                } else {
                    $customer->signature = $oldSign;
                }
                if ($request->hasFile("profile_pic")) {
                    $customer->profile_pic = Upload::image($request, "profile_pic", $this->prfdest, $oldPic);
                } else {
                    $customer->profile_pic = $oldPic;
                }
                $customer->relation = $request->relation;
                $customer->save();
                DB::commit();
                return redirect()->route("admin.booking.show", $customer->booking_id)->with(notify("success", "Relative updated successfully"));
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
            $customer = Customer::findOrFail($id);
            FileUnlink($this->prfdest, $customer->profile_pic);
            FileUnlink($this->destination, $customer->signature);
            $customer->delete();
            return redirect()->back()->with(notify("success", "Relative deleted successfully"));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
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
            "contact_no" => "required|numeric|digits_between:10,13",
            "occupation" => "required|string",
            "identity_no" => "required",
            "signature" => "image|mimes:jpeg,jpg,png|max:2048",
            "profile_pic" => "image|mimes:jpeg,jpg,png|max:2048",
            "relation" => "required|string",
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
            "contact_no.min" => "Contact number must have at least 10 digits",
            "contact_no.numeric" => "Contact number must contain only numeric value",
            "contact_no.digits_between" => "The Contact number length must be 10 to 13",
            "occupation.required" => "Occupation is required",
            "identity_no.required" => "Citizenship number is required",
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

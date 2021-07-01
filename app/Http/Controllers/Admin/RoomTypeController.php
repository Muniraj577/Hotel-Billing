<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    public function index()
    {
        $room_types = RoomType::all();
        return view($this->page."index",compact("room_types"))->with("id");
    }

    public function create()
    {
        return view($this->page."create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $input = $request->except("_token");
                $room_type = RoomType::create($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Room type created successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function edit($id)
    {
        $room_type = RoomType::findOrFail($id);
        return view($this->page."edit",compact("room_type"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $room_type = RoomType::findOrFail($id);
                $input = $request->except("_token");
                $room_type->update($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Room type updated successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with("warning", $e->getMessage());
            }
        }
    }

    private $page = "admin.room_type.";
    private $redirectTo = "admin.room_type.index";
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy("id", "desc")->get();
        return view($this->page."index",compact("units"))->with("id");
    }

    public function create()
    {
        return view($this->page."create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:units,name",
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $input = $request->except("_token");
                $unit = Unit::create($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Unit created successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()))->withInput();
            }
        }
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view($this->page."edit",compact("unit"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required|unique:units,name,".$id,
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $unit = Unit::findOrFail($id);
                $input = $request->except("_token");
                $unit->update($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Unit updated successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()))->withInput();
            }
        }
    }



    private $page = "admin.unit.";
    private $redirectTo = "admin.unit.index";
}

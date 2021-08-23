<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class IdentificationController extends Controller
{
    private $page = "admin.identity.";
    private $redirectTo = "admin.identity.index";

    public function index()
    {
        $identities = Identification::latest()->get();
        return view($this->page."index",compact("identities"))->with("id");
    }

    public function create()
    {
        return view($this->page."create");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => ["required", "unique:identifications,name"],
        ]);

        if($validator->fails()){
            return response()->json(["errors"=>$validator->errors()]);
        }

        if($validator->passes()){
            try{
                DB::beginTransaction();
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->name);
                Identification::create($input);
                DB::commit();
                return response()->json(["msg"=>"Identity created successfully", "redirectRoute"=>route($this->redirectTo)]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error"=>$e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $identity = Identification::findOrFail($id);
        return view($this->page."edit",compact("identity"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            "name"=>["required", "unique:identifications,name,".$id],
        ]);
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $identity = Identification::findOrFail($id);
                $input = $request->except("_token");
                $input["slug"] = getSlug($request->name);
                $identity->update($input);
                DB::commit();
                return response()->json(["msg"=>"Identity is updated successfully", "redirectRoute"=>route($this->redirectTo)]);
            } catch(\Exception $e){
                DB::rollBack();
                return response()->json(["db_error"=>$e->getMessage()]);
            }
        }
    }

}

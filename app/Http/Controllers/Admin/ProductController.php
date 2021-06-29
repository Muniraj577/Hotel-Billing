<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy("id", "desc")->get();
        return view($this->page . "index", compact("products"))->with("id");
    }

    public function create()
    {
        $units = Unit::all();
        return view($this->page . "create", compact("units"));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "unit_id" => "required",
            "name" => "required",
            "price" => "required|numeric",
        ], $this->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $input = $request->except("_token");
                $product = Product::create($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Product created successfully"));
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $units = Unit::all();
        return view($this->page."edit",compact("product", "units"));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            "unit_id" => "required",
            "name" => "required",
            "price" => "required|numeric",
        ], $this->messages());
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($validator->passes()){
            try{
                DB::beginTransaction();
                $product = Product::findOrFail($id);
                $input = $request->except("_token");
                $product->update($input);
                DB::commit();
                return redirect()->route($this->redirectTo)->with(notify("success", "Product updated successfully"));
            } catch(\Exception $e){
                DB::rollBack();
                return redirect()->back()->with(notify("warning", $e->getMessage()));
            }
        }
    }

    private function messages()
    {
        return [
            "name.required" => "Product name is required",
            "unit_id.required" => "Please select unit",
            "price.required" => "Price is required",
            "price.numeric" => "Please enter valid price",
        ];
    }

    private $page = "admin.product.";
    private $redirectTo = "admin.product.index";
}

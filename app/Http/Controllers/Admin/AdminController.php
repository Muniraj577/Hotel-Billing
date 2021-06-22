<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy("id", "desc")->get();
        return view($this->page."index",compact("users"))->with("id");
    }

    public function create()
    {
        return view($this->page."create");
    }

    public function store(AdminRequest $request)
    {
        try{
            DB::beginTransaction();
            $input = $request->except("_token");
            if ($request->hasFile('avatar')) {
                $input['avatar'] = Upload::image($request, 'avatar', $this->destination, '');
            }
            if ($request->filled('type')) {
                $input['type'] = 1;
            }
            $input['password'] = Hash::make($request->password);
            $user = User::create($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify("success", "User created successfully"));
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(notify("warning", $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view($this->page."edit",compact("user"));
    }

    public function update(AdminRequest $request, $id)
    {
        $user = User::findorFail($id);
        $input = $request->except('_token');
        $oldImage = $user->avatar;
        $oldPassword = $user->password;
        try {
            DB::beginTransaction();
            if ($request->hasFile('avatar')) {
                $input['avatar'] = Upload::image($request, 'avatar', $this->destination, $oldImage);
            } else {
                $input['avatar'] = $oldImage;
            }
            if ($request->filled('password')) {
                $input['password'] = Hash::make($request->password);
            } else {
                $input['password'] = $oldPassword;
            }
            if ($request->filled('type')) {
                $input['type'] = 1;
            } else {
                $input['type'] = 0;
            }
            $user->update($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify("success", "User updated successfully"));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(notify('warning', $e->getMessage()));
        }
    }

    public function updateStatus(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $status = $user->status == 1 ? 0 : 1;
        $status_data = $user->status == 1 ? 'Active' : 'Inactive';
        $user->update(['status' => $status]);
        return response()->json(['msg' => 'Admin status updated successfully', 'status' => $user->status]);
    }

    private $page = "admin.user.";
    private $redirectTo = "admin.user.index";
    private $destination = 'images/admin/avatars/';
}

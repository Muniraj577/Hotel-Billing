<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest;
use App\Models\Upload;
use App\Models\User;
use App\Rules\MatchPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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


    public function profile()
    {
        $user = getUser();
        return view($this->page . 'profile', compact('user'));
    }

    public function adminNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchPassword()],
            'password' => 'required|confirmed|min:10|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!@&$#%(){}^*+-]).*$/',
        ], [
            'password.regex' => 'Password must contain at least one uppercase , lowercase, digit and special character',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($validator->passes()) {
            try {
                User::find(getUser()->id)->update(['password' => Hash::make($request->password)]);
                Auth::logout();
                Session::flush();
                return redirect()->route('login');
            } catch (\Exception $e) {
                return redirect()->back()->with(notify('warning', $e->getMessage()));
            }
        }

    }

    public function changeAdminEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email:dns',
        ]);
        User::find(getUser()->id)->update(['email' => $request->email]);
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Email changed successfully.'
        );
        return redirect()->back()->with($notification);
    }

    public function chageAdminAvatar(Request $request)
    {
        $this->validate($request, [
            'phone' => "nullable|numeric|digits_between:10,13",
            'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ],[
            'phone.min' =>'Phone must have at least 10 digits',
            'phone.numeric' => "Phone must contain only numeric value",
            'phone.digits_between'=>"The Phone length must be 10 to 13",
        ]);
        $input = $request->except('_token');
        $oldImage = getUser()->avatar;
        if ($request->hasFile('image')) {
            $input['avatar'] = Upload::image($request, 'image', $this->destination, $oldImage);
        } else {
            $input['avatar'] = $oldImage;
        }
        getUser()->update($input);
        $notification = array(
            'alert-type' => 'success',
            'message' => 'Profile changed successfully.'
        );
        return redirect()->back()->with($notification);
    }

    private $page = "admin.user.";
    private $redirectTo = "admin.user.index";
    private $destination = 'images/admin/avatars/';
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    private $page = 'admin.room.';
    private $redirectTo = 'admin.room.index';

    public function index()
    {
        $rooms = Room::orderBy('id', 'desc')->get();
        return view($this->page."index",compact('rooms'))->with('id');
    }

    public function create()
    {
        return view($this->page."create");
    }

    public function store(RoomRequest $request)
    {
        try{
            DB::beginTransaction();
            $input = $request->except("_token");
            $room = Room::create($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify('success', 'Room created successfully'));
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(notify('warning', $e->getMessage()))->withInput();
        }
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view($this->page."edit",compact("room"));
    }

    public function update(RoomRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $room = Room::findOrFail($id);
            $input = $request->except("_token");
            $room->update($input);
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify('success', 'Room updated successfully'));
        } catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(notify('warning', $e->getMessage()))->withInput();
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $room = Room::findOrFail($id);
            $room->delete();
            DB::commit();
            return redirect()->route($this->redirectTo)->with(notify('success', 'Room deleted successfully'));
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with(notify('warning', $e->getMessage()));
        }
    }
}

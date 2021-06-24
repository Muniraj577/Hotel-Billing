<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\BookingRoom;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    public function getForm(Request $request, $id)
    {
        $booking_detail = BookingDetail::findOrFail($id);
        $rooms = Room::where("status", "Available")->where("is_active", 1)->get();
        return view("admin.partial.room.createForm", compact("rooms", "booking_detail"));
    }

    public function addRoom(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'room_id' => "required",
        ], [
            "room_id.required" => "This field is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $bkd = BookingDetail::findOrFail($id);
                $booking_room = new BookingRoom();
                $booking_room->room_id = $request->room_id;
                $booking_room->booking_id = $id;
                $booking_room->customer_id = $bkd->customer_id;
                $booking_room->save();
                $no_of_room = $bkd->no_of_rooms;
                $bkd->update([
                    "no_of_rooms" => $no_of_room + 1,
                ]);
                DB::commit();
                return response()->json(["msg" => "Room added successfully"]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["error" => $e->getMessage()]);
            }
        }
    }

    public function edit($id)
    {
        $booking_room = BookingRoom::findOrFail($id);
        $rooms = Room::where("is_active", 1)->where("status", "Available")->orWhere("id", $booking_room->room_id)->get();
        return view("admin.partial.room.editForm", compact("booking_room", "rooms"));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'roomid' => "required",
        ], [
            "roomid.required" => "This field is required",
        ]);
        if ($validator->fails()) {
            return response()->json(["errors" => $validator->errors()]);
        }
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $booking_room = BookingRoom::findOrFail($id);
                $room = Room::where("id", $booking_room->room_id)->first()->update(["status" => "Available"]);
                $booking_room->update([
                    "room_id" => $request->roomid,
                ]);
                Room::where("id", $booking_room->room_id)->first()->update(["status" => "UnAvailable"]);
                DB::commit();
                return response()->json(["msg" => "Room updated successfully"]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(["error" => $e->getMessage()]);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        $booking_room = BookingRoom::findOrFail($id);
        $room = Room::where('id', $booking_room->room_id)->first();
        $room->update([
            "status" => "Available",
        ]);
        $bkd = BookingDetail::where("id", $booking_room->booking_id)->first();
        $no_of_room = $bkd->no_of_rooms;
        $bkd->update([
            "no_of_rooms" => $no_of_room - 1,
        ]);
        $booking_room->delete();
        return redirect()->back()->with(notify("success", "Room detail deleted successfully"));
    }
}

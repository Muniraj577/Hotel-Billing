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
    public function addRoom(Request $request, $id)
    {
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
                $booking_room->booking_id = $id;
                $booking_room->customer_id = $bkd->customer_id;
                $booking_room->save();
                DB::commit();
                return response()->json(["success" => "Room added successfully"]);
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

<?php

namespace App\Console\Commands;

use App\Models\BookingDetail;
use App\Models\Room;
use Illuminate\Console\Command;

class RoomStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'room:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update room status to available if today date is greater than departure date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $booking_details = BookingDetail::where("status", 1)->get();
        foreach ($booking_details as $booking_detail) {
            $end_date_time = $booking_detail->departure_date . " " . $booking_detail->departure_time;
            \date_default_timezone_set("Asia/Kathmandu");
            $current_date_time = date("Y-m-d H:i");
            if (strtotime($current_date_time) > strtotime($end_date_time)) {
                $booking_detail->update(["status" => 0]);
            } else {
                $booking_detail->update(["status" => 1]);
            }
            foreach ($booking_detail->booking_rooms as $booking_room) {
                $room = Room::where('id', $booking_room->room_id)->first();
                if (strtotime($current_date_time) > strtotime($end_date_time)) {
                    $room->update(["status" => "Available"]);
                } else {
                    $room->update(["status" => "UnAvailable"]);
                }
            }
        }
        date_default_timezone_set("UTC");
    }
}

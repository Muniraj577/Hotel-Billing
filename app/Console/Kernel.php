<?php

namespace App\Console;

use App\Models\BookingDetail;
use App\Models\Room;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\RoomStatus::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function(){
        //     $booking_details = BookingDetail::all();
        //     foreach($booking_details as $booking_detail){
        //         $end_date_time = $booking_detail->departure_date . " " . $booking_detail->departure_time;
        //         \date_default_timezone_set("Asia/Kathmandu");
        //         $current_date_time = date("Y-m-d H:i");
        //         if(strtotime($current_date_time) > strtotime($end_date_time)){
        //             foreach($booking_detail->booking_rooms as $booking_room){
        //                 $room = Room::where('id', $booking_room->room_id)->first();
        //                 $room->update(["status" => "Available"]);
        //             }
        //         }
        //     }
        //     date_default_timezone_set("UTC");
        // })->everyMinute();

        $schedule->command("room:status")->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

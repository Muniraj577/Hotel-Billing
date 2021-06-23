<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Relative;
use Illuminate\Http\Request;

class RelativeController extends Controller
{
    public function destroy(Request $request, $id)
    {
        $relative = Relative::findOrFail($id);
        $bkd = BookingDetail::where("id", $relative->booking_id)->first();
        $no_of_relative = $bkd->no_of_relative;
        $bkd->update([
            "no_of_relative" => $no_of_relative - 1,
        ]);
        $relative->delete();
        return redirect()->back()->with(notify("success", "Relative deleted successfully"));
    }
}

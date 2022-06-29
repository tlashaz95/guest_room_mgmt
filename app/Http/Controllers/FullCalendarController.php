<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;

class FullCalendarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Bookings::whereDate('From', '>=', $request->From)
                ->whereDate('To', '<=', $request->To)
                ->get(['id', 'Name', 'RoomNo', 'From', 'To']);
            return response()->json($data);
        }
        return view('full-calendar');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $booking = Bookings::create([
                    'Name' => $request->Name,
                    'RoomNo' => $request->RoomNo,
                    'From' => $request->From,
                    'To' => $request->To
                ]);

                return response()->json($booking);
            }

            if ($request->type == 'update') {
                $booking = Bookings::find($request->id)->update([
                    'Name' => $request->Name,
                    'RoomNo' => $request->RoomNo,
                    'From' => $request->From,
                    'To' => $request->To
                ]);

                return response()->json($booking);
            }

            if ($request->type == 'delete') {
                $booking = Bookings::find($request->id)->delete();

                return response()->json($booking);
            }
        }
    }
}

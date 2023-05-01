<?php

namespace App\Http\Controllers\Pages\Session\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySessions\MySessionsBooking;

class MySessionController extends Controller
{
    public function index()
    {
        return view('pages.my-session.index');
    }

    public function confirmation($slug)
    {
        $mySessionsBooking = MySessionsBooking::where('slug', $slug)->first();
        
        $end_datetime = date("Y-m-d H:i", strtotime($mySessionsBooking->belongsToAppointment->belongsToMySessionDate->date.''.$mySessionsBooking->belongsToAppointment->end_time));
        $now = date("Y-m-d H:i");

        $now >= $end_datetime ? abort(404) : true;

        return view('pages.my-session.confirmation')->with('mySessionsBooking', $mySessionsBooking);
    }
}

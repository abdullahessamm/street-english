<?php

namespace App\Http\Controllers\Pages\Sessions\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MySessions\MySession;
use App\Models\MySessions\MySessionAppointment;
use App\Models\MySessions\MySessionDate;

class MySessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.my-session.index');
    }

    public function create()
    {
        return view('pages.my-session.create');
    }

    public function show($slug)
    {
        $mySession = MySession::where('slug', $slug)->first();

        return view('pages.my-session.show')->with('mySession', $mySession);
    }

    public function dates($slug)
    {
        $mySession = MySession::where('slug', $slug)->first();

        return view('pages.my-session.dates')->with('mySession', $mySession);
    }

    public function appointments($my_session_slug, $date_slug)
    {
        $mySessionDate = MySessionDate::where('slug', $date_slug)->first();
        
        return view('pages.my-session.appointments')->with('mySessionDate', $mySessionDate);
    }

    public function booking($my_session_slug, $date_slug, $appointment_id, $booking_slug)
    {
        $myAppointment = MySessionAppointment::where('id', $appointment_id)->first();

        $myAppointment == null ? abort(404) : true;
        
        return view('pages.my-session.booking')->with('myAppointment', $myAppointment);
    }
}

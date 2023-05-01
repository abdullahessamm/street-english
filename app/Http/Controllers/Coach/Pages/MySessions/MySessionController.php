<?php

namespace App\Http\Controllers\Coach\Pages\MySessions;

use App\Coach;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaches\Sessions\CoachSession;
use App\Models\Coaches\Sessions\CoachSessionDate;
use Illuminate\Support\Facades\Auth;

class MySessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function index()
    {
        $coachSessions = Coach::where('id', Auth::guard('coach')->user()->id)->first()->sessions;

        return view('coach.pages.my-session.index')->with('coachSessions', $coachSessions);
    }

    public function show($slug)
    {
        $coachSession = CoachSession::where('coach_id', Auth::guard('coach')->user()->id)->where('slug', $slug)->first();

        if($coachSession == null)
        {
            abort(404);
        }

        $coachSessionDates = CoachSessionDate::where('coach_session_id', $coachSession->id)->get();
        
        return view('coach.pages.my-session.show')
        ->with('coachSession', $coachSession)
        ->with('coachSessionDates', $coachSessionDates);
    }

    public function date($my_session_slug, $date_slug)
    {
        $coachSessionDate = CoachSessionDate::where('slug', $date_slug)->first();
        
        return view('coach.pages.my-session.date')->with('coachSessionDate', $coachSessionDate);
    }

    public function appointment($my_session_slug, $appointment_slug)
    {
        return view('coach.pages.my-session.appointment');
    }
}

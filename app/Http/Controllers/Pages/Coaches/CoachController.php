<?php

namespace App\Http\Controllers\Pages\Coaches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Courses\CourseInstructor;
use App\Models\Coaches\Sessions\CoachSessionBooking;
use App\Models\Coaches\Blogs\CoachPost;
use App\Coach;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::paginate(6);

        return view('pages.coach.index')->with('coaches', $coaches);
    }

    public function show($id)
    {
        $coach = Coach::where('id', $id)->first();

        $coachCourses = CourseInstructor::where('coach_id', $coach->id)
        ->where('approved', 1)
        ->where('suspend', 0)
        ->get();

        $coachPosts = CoachPost::where('coach_id', $coach->id)->get();

        return view('pages.coach.show')
        ->with('coach', $coach)
        ->with('coachCourses', $coachCourses)
        ->with('coachPosts', $coachPosts);
    }

    public function confirmation($coach_id, $slug)
    {
        $coachSessionBooking = CoachSessionBooking::where('slug', $slug)->first();
        
        $end_datetime = date("Y-m-d H:i", strtotime($coachSessionBooking->belongsToAppointment->belongsToCoachSessionDate->date.''.$coachSessionBooking->belongsToAppointment->end_time));
        $now = date("Y-m-d H:i");

        $now >= $end_datetime ? abort(404) : true;

        return view('pages.coach.meeting-confirmation')->with('coachSessionBooking', $coachSessionBooking);
    }
}

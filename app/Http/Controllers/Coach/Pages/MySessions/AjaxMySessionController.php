<?php

namespace App\Http\Controllers\Coach\Pages\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coaches\Sessions\CoachSession;
use App\Models\Coaches\Sessions\CoachSessionDate;
use App\Models\Coaches\Sessions\CoachSessionAppointment;

class AjaxMySessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function create(Request $request)
    {
        $coach_id = Auth::guard('coach')->user()->id;
        $session_name = $request->input('session_name');
        $session_date = $request->input('session_date');
        $description = nl2br($request->input('description'));
        $slug = $this->slugify($session_name);

        // create session data
        $CoachSession = CoachSession::firstOrCreate(['coach_id' => $coach_id,'slug' => $slug], [
            'name' => $session_name,
            'description' => $description,
            'slug' => $slug,
        ]);

        // create session date
        $CoachSessionDate = CoachSessionDate::firstOrCreate(['coach_session_id' => $CoachSession->id, 'date' => $session_date], [
            'coach_session_id' => 123,
            'date' => $session_date,
            'slug' => md5(uniqid()),
        ]);

        // create session appointments
        $appointments = $request->input('appointments');

        for($i = 0; $i < count($appointments); $i++)
        {
            CoachSessionAppointment::firstOrCreate([
                'coach_session_date_id' => $CoachSessionDate->id,
                'start_time' => $appointments[$i]['start_time'],
                'end_time' => $appointments[$i]['end_time'],
                'link' => $appointments[$i]['link'],
            ],[
                'coach_session_date_id' => $CoachSessionDate->id,
                'start_time' => $appointments[$i]['start_time'],
                'link' => $appointments[$i]['link'],
            ]);
        }

        $this->successMsg('تم انشاء جلسة جديدة');

        $this->redierctTo('/coach/my-session/'.$slug);
    }

    public function update(Request $request)
    {
        $my_session_id = $request->input('my_session_id');
        $session_name = $request->input('session_name');
        $description = nl2br($request->input('description'));
        $slug = $this->slugify($session_name);

        CoachSession::where('id', $my_session_id)->update([
            'name' => $session_name,
            'description' => $description,
            'slug' => $slug,
        ]);

        $this->successMsg('تم تحديث بيانات جلسة');

        $this->redierctTo('/coach/my-session/'.$slug);
    }

    public function delete(Request $request)
    {
        $my_session_id = $request->input('my_session_id');

        if(CoachSession::where('id', $my_session_id)->delete())
        {
            $this->successMsg('تم مسح الجلسة بجميع محتويتها');

            $this->redierctTo('coach/my-sessions');
        }
    }

    public function createDate(Request $request)
    {
        $coach_session_id = $request->input('coach_session_id');
        $coach_session_slug = $request->input('coach_session_slug');
        $session_date = $request->input('session_date');
        $slug = $this->slugify($session_date);

        // create session date
        $CoachSessionDate = CoachSessionDate::firstOrCreate(['coach_session_id' => $coach_session_id, 'slug' => $slug], [
            'coach_session_id' => $coach_session_id,
            'date' => $session_date,
            'slug' => $slug,
        ]);

        // create session appointments
        $appointments = $request->input('appointments');

        for($i = 0; $i < count($appointments); $i++)
        {
            CoachSessionAppointment::firstOrCreate([
                'coach_session_date_id' => $CoachSessionDate->id,
                'start_time' => $appointments[$i]['start_time'],
                'end_time' => $appointments[$i]['end_time'],
                'link' => $appointments[$i]['link'],
            ],[
                'coach_session_date_id' => $CoachSessionDate->id,
                'start_time' => $appointments[$i]['start_time'],
                'link' => $appointments[$i]['link'],
            ]);
        }

        $this->successMsg('تم انشاء مواعيد بتاريخ : '.$session_date);

        $this->redierctTo('/coach/my-session/'.$coach_session_slug);
    }

    public function deleteDate(Request $request)
    {        
        $my_session_slug = $request->input('my_session_slug');
        $date_id = $request->input('date_id');

        if(CoachSessionDate::where('id', $date_id)->delete())
        {
            $this->successMsg("تم مسح هذا التاريخ بمواعيدة");
            $this->redierctTo('coach/my-session/'.$my_session_slug);
        }
    }

    public function createAppointment(Request $request)
    {
        $coach_session_date_id = $request->input('coach_session_date_id');

        // create session appointments
        $appointments = $request->input('appointments');

        for($i = 0; $i < count($appointments); $i++)
        {
            CoachSessionAppointment::firstOrCreate([
                'coach_session_date_id' => $coach_session_date_id,
                'start_time' => $appointments[$i]['start_time'],
                'end_time' => $appointments[$i]['end_time'],
                'link' => $appointments[$i]['link'],
            ],[
                'coach_session_date_id' => $coach_session_date_id,
                'start_time' => $appointments[$i]['start_time'],
                'link' => $appointments[$i]['link'],
            ]);
        }

        $this->successMsg('تم اضافة مواعيد جديدة');

        $this->reloadPage();
    }

    public function deleteAppointment(Request $request)
    {
        $appointment_id = $request->input('appointment_id');

        if(CoachSessionAppointment::where('id', $appointment_id)->delete())
        {
            $this->successMsg("تم مسح هذا الميعاد");
        }
    }
}

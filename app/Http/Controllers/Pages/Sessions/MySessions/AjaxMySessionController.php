<?php

namespace App\Http\Controllers\Pages\Sessions\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\MySessions\MySession;
use App\Models\MySessions\MySessionDate;
use App\Models\MySessions\MySessionAppointment;
use App\Models\MySessions\MySessionsBooking;

class AjaxMySessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $mySession = MySession::query();

        return Datatables::of($mySession)
        ->editColumn('name', function ($mySession) {
            return '<a href="'.route('my-session.show', [$mySession->slug]).'">'.$mySession->name.'</a>';
        })
        ->editColumn('session_dates', function ($mySession) {
            return $mySession->dates()->count();
        })
        ->editColumn('delete_session', function ($mySession) {
            return '<button class="btn btn-danger btn-sm deleteSession" data-session-id="'.$mySession->id.'">مسح الجلسة</button>';
        })
        ->rawColumns(['name', 'session_dates', 'delete_session'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $session_name = $request->input('session_name');
        $description = nl2br($request->input('description'));
        $slug = $this->slugify($session_name);

        MySession::firstOrCreate(['slug' => $slug], [
            'name' => $session_name,
            'description' => $description,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء جلسة جديدة');

        $this->redierctTo('/my-session/'.$slug);
    }

    public function update(Request $request)
    {
        $my_session_id = $request->input('my_session_id');
        $session_name = $request->input('session_name');
        $description = nl2br($request->input('description'));
        $slug = $this->slugify($session_name);

        MySession::where('id', $my_session_id)->update([
            'name' => $session_name,
            'description' => $description,
            'slug' => $slug,
        ]);

        $this->successMsg('تم تحديث جلسة');

        $this->redierctTo('/my-session/'.$slug);
    }

    public function delete(Request $request)
    {
        $my_session_id = $request->input('my_session_id');

        if(MySession::where('id', $my_session_id)->delete())
        {
            $this->successMsg('تم مسح الجلسة بجميع محتويتها');

            $this->redierctTo('/my-sessions');
        }
    }

    public function createDate(Request $request)
    {
        $my_session_id = $request->input('my_session_id');

        $mySession = MySession::where('id', $my_session_id)->first();

        $date = $request->input('date');
        $slug = $this->slugify($date);

        MySessionDate::firstOrCreate(['slug' => $slug], [
            'my_session_id' => $my_session_id,
            'date' => $date,
            'slug' => $slug,
        ]);

        $this->successMsg('تم انشاء تاريخ للجلسة');

        $this->redierctTo('/my-session/'.$mySession->slug.'/date/'.$slug.'/appointments');
    }

    public function deleteDate(Request $request)
    {
        $date_id = $request->input('date_id');

        if(MySessionDate::where('id', $date_id)->delete())
        {
            $this->successMsg("تم مسح هذا التاريخ بمواعيدة");
        }
    }

    public function createAppointment(Request $request)
    {
        $my_session_date_id = $request->input('my_session_date_id');
        $appointments = $request->input('appointments');

        for($i = 0; $i < count($appointments); $i++)
        {
            MySessionAppointment::firstOrCreate([
                'my_session_date_id' => $my_session_date_id,
                'start_time' => $appointments[$i]['start_time'],
                'end_time' => $appointments[$i]['end_time'],
                'link' => $appointments[$i]['link'],
            ],[
                'my_session_date_id' => $my_session_date_id,
                'start_time' => $appointments[$i]['start_time'],
                'end_time' => $appointments[$i]['end_time'],
                'link' => $appointments[$i]['link'],
            ]);
        }

        $this->successMsg('تم انشاء المواعيد');

        $this->reloadPage();
    }

    public function deleteAppointment(Request $request)
    {
        $appointment_id = $request->input('appointment_id');

        if(MySessionAppointment::where('id', $appointment_id)->delete())
        {
            $this->successMsg("تم مسح هذا الميعاد");
        }
    }

    public function deleteBooking(Request $request)
    {
        $appointment_booking_id = $request->input('appointment_booking_id');

        $mySessionsBooking = MySessionsBooking::where('my_session_appointment_id', $appointment_booking_id)->first();
        
        $date_slug = $mySessionsBooking->belongsToAppointment->belongsToMySessionDate->slug;
        $my_sessions_slug = $mySessionsBooking->belongsToAppointment->belongsToMySessionDate->belongsToMySession->slug;

        if($mySessionsBooking->delete())
        {
            MySessionAppointment::where('id', $appointment_booking_id)->update([
                'isTaken' => 0
            ]);
            
            $this->redierctTo('my-session/'.$my_sessions_slug.'/date/'.$date_slug.'/appointments');

            $this->successMsg("تم الغاء الميعاد");
        }
    }
}

<?php

namespace App\Http\Controllers\Pages\Coaches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Coaches\Sessions\CoachSession;
use App\Models\Coaches\Sessions\CoachSessionDate;
use App\Models\Coaches\Sessions\CoachSessionAppointment;
use App\Models\Coaches\Sessions\CoachSessionBooking;
use App\User;

class AjaxCoachController extends Controller
{
    public function calendar($coach_id)
    {
        $meetings = CoachSession::where('coach_id', $coach_id)->get();

        if(count($meetings) > 0)
        {
            foreach($meetings as $meeting)
            {
                foreach($meeting->dates as $date)
                {
                    $dates[] = [
                        'id' => $date->id,
                        'badge' => true,
                        'date' => $date->date,
                        'hasEvent' => true,
                        'classname' => 'open-popup',
                        'hrefname' => '#popup-info'
                    ];
                }
            }
        }
        else
        {
            $dates = [];
        }

        echo json_encode($dates);
    }

    public function calendarAppointments(Request $request)
    {
        $date = $request->input('date');

        $meetingDate = CoachSessionDate::where('date', $date)->first();

        $getAllappointments = $meetingDate->appointments->count();
        $takenAppointments = $meetingDate->takenAppointments->count();

        $checkIfAllAppointmentsAreTaken = $getAllappointments == $takenAppointments ? true : false;
        
        if($checkIfAllAppointmentsAreTaken)
        {
            return view('pages.coach.no-appointments-avalaible')->with('date', $date);
        }
        else
        {
            foreach($meetingDate->appointments as $appointment)
            {
                $date1 = date("Y-m-d H:i", strtotime($appointment->belongsToCoachSessionDate->date.' '.$appointment->start_time));
                $date2 = date("Y-m-d H:i");
    
                if($date1 > $date2)
                {
                    $appointments[] = [
                        'appointment_id' => $appointment->id,
                        'is_taken' => $appointment->isTaken == 1 ? 1 : 0,
                        'start_time' => $appointment->start_time,
                    ];
                }
            }
            
            return view('pages.coach.appointments')
            ->with('date', $date)
            ->with('appointments', $appointments);
        }
    }

    public function bookAppointment(Request $request)
    {
        $appointment_id = $request->input('appointment');
        $name = $request->input('name');
        $email = $request->input('email');
        $whatsapp_number = $request->input('phone');
        $slug = md5(uniqid());

        $CoachSessionAppointment = CoachSessionAppointment::where('id', $appointment_id)->first();
        $form_time = date("h:i a", strtotime($CoachSessionAppointment->start_time));
        $to_time = date("h:i a", strtotime($CoachSessionAppointment->end_time));

        $user_id = User::where('email', $email)->first() == null ? null : User::where('email', $email)->first()->id;

        if(CoachSessionBooking::where('email', $email)->where('coach_session_appointment_id', $CoachSessionAppointment->id)->first() == null)
        {
            $appointment = CoachSessionBooking::create([
                'coach_session_appointment_id' => $appointment_id,
                'user_id' => $user_id,
                'name' => $name,
                'email' => $email,
                'whatsapp_number' => $whatsapp_number,
                'slug' => $slug,
            ]);

            $CoachSessionAppointment->update([
                'isTaken' => 1
            ]);

            $CoachSessionAppointment = CoachSessionAppointment::where('id', $appointment_id)->first();

            $data = [
                'email' => $email,
                'CoachSessionAppointment' => $CoachSessionAppointment,
                'slug' => $slug,
            ];
    
            Mail::send('mail.confirm-appointment-with-coach', ['data' => $data], function ($message) use ($data) {
                $message->to( $data['email'] )
                ->from('info@'.config('app.domain'))
                ->subject( 'Meeting Confirmed' );
            });

            $this->successMsg("You booked a meeting session from ".$form_time." to ".$to_time);
        }
        else
        {
            $this->successMsg("You already book this meeting please check your email");
        }


        /*if(UserBooking::where('meeting_appointment_id', $appointment_id)->where('email', $email)->first() == null)
        {
            $UserBooking = new UserBooking();
            $UserBooking->meeting_appointment_id = $appointment_id;
            $UserBooking->firstname = $firstname;
            $UserBooking->lastname = $lastname;
            $UserBooking->email = $email;
            $UserBooking->phone = $phone;
            

            if($UserBooking->save())
            {
                echo '
                <div class="text-center">
                    <i class="fa fa-check text-success" style="font-size:100px;"></i>
                    <h4>تم حجز جلستك بنجاح من فضلك تحقق من بريدك الالكتروني</h4>
                </div>
                ';
            }
        }
        else
        {
            echo '
            <div class="text-center">
                <i class="fa fa-check text-success" style="font-size:100px;"></i>
                <h4>تم حجز جلستك بنجاح من فضلك تحقق من بريدك الالكتروني</h4>
            </div>
            ';
        }*/
    }
}

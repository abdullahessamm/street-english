<?php

namespace App\Http\Controllers\Web\Pages\Courses\TrainingCourses;

use App\Http\Controllers\Web\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\TrainingCourses\TrainingCourse;
use App\Models\EnrolledStudents\EnrolledStudentForTrainingCourse;
use App\User;

class AjaxTrainingCourseController extends Controller
{
    public function joinEventForPublicUser(Request $request)
    {
        $training_course_id = $request->input('training_course_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $whatsapp_number = $request->input('phone');
        $ticket = rand(10000, 99999);
        $slug = md5(uniqid());

        $user = User::where('email', $email)->first() != null ? User::where('email', $email)->first() : null;
        
        $trainingCourse = TrainingCourse::where('id', $training_course_id)->first();

        if(EnrolledStudentForTrainingCourse::where('training_course_id', $trainingCourse->id)->where('email', $email)->first() != null)
        {
            $this->successMsg("You already joined this event. Please check your email.");
            die();
        }


        if($user == null)
        {
            // for non registed users
            EnrolledStudentForTrainingCourse::firstOrCreate(['email' => $email, 'training_course_id' => $trainingCourse->id], [
                'training_course_id' => $trainingCourse->id,
                'name' => $name,
                'email' => $email,
                'whatsapp_number' => $whatsapp_number,
                'ticket' => $ticket,
                'slug' => $slug,
            ]);
        }
        else
        {
            // for registed users
            EnrolledStudentForTrainingCourse::firstOrCreate(['user_id' => $user->id, 'training_course_id' => $trainingCourse->id], [
                'user_id' => $user->id,
                'name' => $name,
                'email' => $email,
                'whatsapp_number' => $whatsapp_number,
                'training_course_id' => $trainingCourse->id,
                'ticket' => $ticket,
                'slug' => $slug,
            ]);
        }
        
        $data = [
            'email' => $email,
            'trainingCourse' => $trainingCourse,
            'slug' => $slug,
        ];

        Mail::send('mail.confirm-event', ['data' => $data], function ($message) use ($data) {
            $message->to( $data['email'] )
            ->from('info@'.config('app.domain'))
            ->subject( 'Event Joining' );
        });

        $this->successMsg("You have joined this event. Please check your email for more detail");
    }
}

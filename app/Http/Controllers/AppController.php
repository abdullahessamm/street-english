<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courses\Course;
use App\Models\Courses\PopularCourse;
use App\Models\WorkWithUsForm;
use App\Subscribe;

class AppController extends Controller
{
    public function index()
    {
        $popularCourses = PopularCourse::orderBy('created_at', 'desc')->get();

        return view('index')
        ->with('popularCourses', $popularCourses);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function workWithUs()
    {
        return view('pages.work-with-us');
    }

    public function submitWorkWithUs(Request $request)
    {
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $phone_number = $request->input('phone_number');
        $whatsapp_number = $request->input('whatsapp_number');
        $dob = $request->input('dob');
        $address = nl2br($request->input('address'));
        $matrial_status = $request->input('matrial_status');
        $military_status = $request->input('military_status');
        $personal_id_number = $request->input('personal_id_number');
        $are_you_a = $request->input('are_you_a');
        $graduation_year = $request->input('graduation_year');
        $educational_background = nl2br($request->input('educational_background'));
        $why_are_you_applying = nl2br($request->input('why_are_you_applying'));
        $how_long_have_you_been_working = $request->input('how_long_have_you_been_working');
        $name_3_places = nl2br($request->input('name_3_places'));
        $extra_qualifications = nl2br($request->input('graduation_year'));
        $salaray = $request->input('salaray');
        $work_date_availability = $request->input('work_date_availability');
        $how_long_have_you_been_working = $request->input('how_long_have_you_been_working');
        $answer_the_following_3_Questions = $request->input('answer_the_following_3_Questions');

        if(WorkWithUsForm::where('email', $email)->first() != null){

            $our_email = 'job@'.config('app.domain');

            echo <<<HTML
            <i class="fa fa-check text-success" style="font-size: 100px;"></i>
            <h1>Your request has been already sent</h1>
            <h3>We wil reply soon at this email {$email}</h3>
            <h6><b>NOTE</b> if you didn't get any reply from us within 24 hours please send message to {$our_email}</h6>
            HTML;

            die();
        }

        WorkWithUsForm::create([
            'fullname' => $fullname,
            'email' => $email,
            'phone_number' => $phone_number,
            'whatsapp_number' => $whatsapp_number,
            'dob' => $dob,
            'address' => $address,
            'matrial_status' => $matrial_status,
            'military_status' => $military_status,
            'personal_id_number' => $personal_id_number,
            'are_you_a' => $are_you_a,
            'graduation_year' => $graduation_year,
            'educational_background' => $educational_background,
            'why_are_you_applying' => $why_are_you_applying,
            'how_long_have_you_been_working' => $how_long_have_you_been_working,
            'name_3_places' => $name_3_places,
            'extra_qualifications' => $extra_qualifications,
            'salaray' => $salaray,
            'work_date_availability' => $work_date_availability,
            'answer_the_following_3_Questions' => $answer_the_following_3_Questions
        ]);

        echo <<<HTML
        <i class="fa fa-check text-success" style="font-size: 100px;"></i>
        <h1>Your request has been sent.</h1>
        <h3>We wil reply soon at this email {$email}</h3>
        HTML;
    }

    public function subscribe(Request $request)
    {
        $email = $request->input('email');

        $subscriber = Subscribe::where('email', $email)->first();

        if($subscriber == null){

            echo <<<HTML
            <div class="text-center">
                <h3>Thanks For your Subscription.</h3>
            </div>
    
            <script>
                $("#subscribe").hide();
            </script>
            HTML;
            
        }else{

            echo <<<HTML
            <div class="text-center">
                <h3>You already on our subscribers list.</h3>
            </div>
    
            <script>
                $("#subscribe").hide();
            </script>
            HTML;
        }
    }
}

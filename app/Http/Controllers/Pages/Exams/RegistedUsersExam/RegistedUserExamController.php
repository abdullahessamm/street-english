<?php

namespace App\Http\Controllers\Pages\Exams\RegistedUsersExam;

use App\Http\Controllers\Controller;
use App\Models\Exams\Exam;
use App\Models\Exams\RegistedUserExam;
use App\Models\Students\Student;
use Illuminate\Http\Request;

class RegistedUserExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.registed-users-exams.index');
    }

    public function show($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        if($exam == null)
        {
            $this->redierctTo('exams');
        }

        $get_exams_registed_users = RegistedUserExam::where('exam_id', $exam->id)->get('user_id')->toArray();
        $not_registed_users = Student::whereNotIn('id', $get_exams_registed_users)->get();

        return view('pages.registed-users-exams.show')
        ->with('not_registed_users', $not_registed_users)
        ->with('exam', $exam);
    }
}

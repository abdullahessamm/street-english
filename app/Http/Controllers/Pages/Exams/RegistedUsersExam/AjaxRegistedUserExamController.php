<?php

namespace App\Http\Controllers\Pages\Exams\RegistedUsersExam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Exams\Exam;
use App\Models\Exams\RegistedUserExam;

class AjaxRegistedUserExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $exam = Exam::query();

        return Datatables::of($exam)
        ->editColumn('exam_name', function ($exam) {
            return '<a href="'.route('exam.show', [$exam->slug]).'">'.$exam->exam_name.'</a>';
        })
        ->editColumn('registed_users', function ($exam) {
            return '<a href="'.route('registed-users.show', [$exam->slug]).'">'.$exam->registedUsers->count().'</a>';
        })
        ->rawColumns(['exam_name', 'registed_users'])
        ->make(true);
    }

    public function append(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $students = $request->input('students');

        for($i = 0; $i < count($students); $i++)
        {
            RegistedUserExam::firstOrCreate(['exam_id' => $exam_id, 'user_id' => $students[$i]], [
                'exam_id' => $exam_id,
                'user_id' => $students[$i],
                'slug' => md5(uniqid()),
            ]);
        }

        $this->successMsg(count($students) == 1 ? 'New student has been added in this exam' : 'New students has been added in this exam');

        $this->reloadPage();
    }

    public function remove(Request $request)
    {
        $user_id = $request->input('user_id');

        if(RegistedUserExam::where('user_id', $user_id)->delete())
        {
            $this->successMsg('This user has been removed from this exam.');
        }
    }
}

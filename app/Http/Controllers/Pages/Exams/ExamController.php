<?php

namespace App\Http\Controllers\Pages\Exams;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Exams\Exam;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('pages.exams.index');
    }

    public function create()
    {
        return view('pages.exams.create');
    }

    public function show($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        if($exam == null)
        {
            abort(404);
        }

        return view('pages.exams.show')->with('exam', $exam);
    }

    public function preview($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        if($exam == null)
        {
            abort(404);
        }

        $route = route('exam.show', [$exam->slug]);

        if($exam->exam_date != null && $exam->end_at != null){

            $date1 = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' '.date('H:i:s'));
            $date2 = Carbon::createFromFormat('Y-m-d H:i:s', $exam->exam_date.' '.$exam->end_at);
    
            if($date2->lt($date1))
            {
                echo '<h1>This exam has been expired</h1>';
                die();
            }
        }

        return view('pages.exams.preview')
        ->with('exam', $exam)
        ->with('route', $route);
    }

    public function previewExamTimeType(Request $request)
    {
        $exam_time_type = $request->input('exam_time_type');

        switch ($exam_time_type)
        {
            case 'specific_date_and_time':
                return view('pages.exams.choose-time-type.specific-time');
            break;

            case 'anytime':
                return view('pages.exams.choose-time-type.anytime');
            break;
        }
    }
}

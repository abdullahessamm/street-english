<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Exams\Exam;
use Illuminate\Http\Request;

class PreviewExamController extends Controller
{
    public function index($slug)
    {
        $exam = Exam::where('slug', $slug)->first();

        return view('pages.public-exam.preview')->with('exam', $exam);
    }
}

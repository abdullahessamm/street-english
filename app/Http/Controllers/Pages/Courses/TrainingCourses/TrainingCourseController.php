<?php

namespace App\Http\Controllers\Pages\Courses\TrainingCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingCourses\TrainingCourse;
use App\Models\TrainingCourses\PublicUserForTrainingCourse;
use App\Models\EnrolledStudents\EnrolledStudentForTrainingCourse;

class TrainingCourseController extends Controller
{
    public function index()
    {
        $trainingCourses = TrainingCourse::get();
        
        return view('pages.training-course.index')->with('trainingCourses', $trainingCourses);
    }

    public function show($slug)
    {
        $trainingCourse = TrainingCourse::where('slug', $slug)->first();

        $trainingCourse == null ? $this->redierctTo('training-courses') : true;
        $trainingCourse->contents->count() == 0 ? abort(404) : true;

        EnrolledStudentForTrainingCourse::where('id', $trainingCourse)->count();

        return view('pages.training-course.show')->with('trainingCourse', $trainingCourse);
    }

    public function confirmation($slug)
    {
        $confirmation = EnrolledStudentForTrainingCourse::where('slug', $slug)->first();
        
        return$confirmation == null ? view('pages.training-course.not-found') : view('pages.training-course.confirmation')->with('confirmation', $confirmation);
    }
}

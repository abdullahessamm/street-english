<?php

namespace App\Http\Controllers\Pages\TrainingCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TrainingCourses\TrainingCourse;
use App\Models\TrainingCourses\TrainingCourseCategory;
use App\Models\TrainingCourses\TrainingCourseInstructor;
use App\Models\Coaches\Coach;

class TrainingCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.training-courses.index');
    }

    public function create()
    {
        $coaches = Coach::get();

        $trainingCourseCategories = TrainingCourseCategory::count() == 0 ? $this->redierctTo('training-courses/categories') : TrainingCourseCategory::get();

        return view('pages.training-courses.create')
        ->with('trainingCourseCategories', $trainingCourseCategories)
        ->with('coaches', $coaches);
    }

    public function show($slug)
    {
        $trainingCourse = TrainingCourse::where('slug', $slug)->first();
        $coaches = Coach::get();

        if($trainingCourse == null)
        {
            $this->redierctTo('training-courses');
        }

        $trainingCourseCategories = TrainingCourseCategory::get();

        return view('pages.training-courses.show')
        ->with('trainingCourse', $trainingCourse)
        ->with('trainingCourseCategories', $trainingCourseCategories)
        ->with('coaches', $coaches);
    }

    public function contents($slug)
    {
        $trainingCourse = TrainingCourse::where('slug', $slug)->first();

        return view('pages.training-courses.contents')->with('trainingCourse', $trainingCourse);
    }
}

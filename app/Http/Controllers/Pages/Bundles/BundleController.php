<?php

namespace App\Http\Controllers\Pages\Bundles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bundles\Bundle;
use App\Models\Bundles\BundleCourse;
use App\Models\Bundles\BundleUser;
use App\Models\Courses\Course;
use App\Models\Students\Student;

class BundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.bundle.index');
    }

    public function show($slug)
    {
        $bundle = Bundle::where('slug', $slug)->first();

        if($bundle == null)
        {
            $this->redierctTo('bundles');
        }

        return view('pages.bundle.show')->with('bundle', $bundle);
    }

    public function courses($slug)
    {
        $bundle = Bundle::where('slug', $slug)->first();

        if($bundle == null)
        {
            $this->redierctTo('bundles');
        }
        
        $get_courses_bundle = BundleCourse::where('bundle_id', $bundle->id)->get('course_id')->toArray();

        $not_add_courses = Course::whereNotIn('id', $get_courses_bundle)->get();

        return view('pages.bundle.courses')
        ->with('not_add_courses', $not_add_courses)
        ->with('bundle', $bundle);
    }

    public function users($slug)
    {
        $bundle = Bundle::where('slug', $slug)->first();

        if($bundle == null)
        {
            $this->redierctTo('bundles');
        }
        
        $get_courses_bundle = BundleUser::where('bundle_id', $bundle->id)->get('user_id')->toArray();

        $not_registed_users = Student::whereNotIn('id', $get_courses_bundle)->get();

        return view('pages.bundle.users')
        ->with('not_registed_users', $not_registed_users)
        ->with('bundle', $bundle);
    }
}

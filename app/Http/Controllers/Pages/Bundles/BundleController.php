<?php

namespace App\Http\Controllers\Pages\Bundles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bundles\Bundle;
use App\Models\Bundles\BundleUser;
use App\Models\Courses\Course;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\Models\Students\Student;
use Illuminate\Support\Facades\Auth;

class BundleController extends Controller
{
    public function index()
    {
        $bundles = Bundle::get();

        return view('pages.bundle.index')->with('bundles', $bundles);
    }

    public function show($slug)
    {
        $bundle = Bundle::where('slug', $slug)->first();

        return view('pages.bundle.show')->with('bundle', $bundle);
    }

    public function buyBundle(Request $request)
    {
        $bundle_id = $request->input('bundle_id');
        $user_id = $request->input('user_id');
        $slug = md5(uniqid());

        $bundle = Bundle::where('id', $bundle_id)->first();

        BundleUser::firstOrCreate(['bundle_id' => $bundle_id, 'user_id' => $user_id],[
            'bundle_id' => $bundle_id,
            'user_id' => $user_id,
            'slug' => $slug,
        ]);

        foreach($bundle->bundleCourses as $eachBundleCourse){

            EnrolledStudentForCourse::create([
                'course_id' => $eachBundleCourse->course_id,
                'user_id' => $user_id,
            ]);
        }

        $this->successMsg('Bundle has been added to your dashboard successfully.');

        $this->redierctTo('student/my-bundle/show/'.$slug);
    }
}

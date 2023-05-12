<?php

namespace App\Http\Controllers\Pages\Bundles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Bundles\Bundle;
use App\Models\Bundles\BundleCourse;
use App\Models\Bundles\BundleUser;

class AjaxBundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $bundle = Bundle::query();

        return Datatables::of($bundle)
        ->editColumn('name', function ($bundle) {
            return  '<a href="'.route('bundle.show', $bundle->slug).'">'.$bundle->name.'</a>';
        })
        ->editColumn('number_of_courses', function ($bundle) {
            return '<a href="'.route('bundle.courses', $bundle->slug).'">'.$bundle->bundleCourses->count().'</a>';
        })
        ->editColumn('number_of_users', function ($bundle) {
            return '<a href="'.route('bundle.users', $bundle->slug).'">'.$bundle->bundleUsers->count().'</a>';
        })
        ->editColumn('created_at', function ($bundle) {
            return date("Y-m-d h:i:s a", strtotime($bundle->created_at));
        })
        ->editColumn('delete_bundle', function ($bundle) {
            return '<button class="btn btn-danger btn-sm deleteBundle" data-bundle-id="'.$bundle->id.'">Delete this Bundle</button>';
        })
        ->rawColumns(['name', 'number_of_courses', 'number_of_users', 'delete_bundle'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $bundle_name = $request->input('bundle_name');
        $price = $request->input('price');
        $thumbnail = $request->file('thumbnail');
        $banner = null;
        $slug = $this->slugify($bundle_name);
        
        // check if banner is uploaded
        if($request->hasFile('banner'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('banner')->getClientOriginalExtension(), "Banner image extension is not allowed");

            $banner = 'banner.'.$request->file('banner')->getClientOriginalExtension();
        }
        
        $bundle = Bundle::firstOrCreate(['slug' => $slug], [
            'name' => $bundle_name,
            'price' => $price,
            'thumbnail' => 'thumbnail.'.$thumbnail->getClientOriginalExtension(), 
            'banner' => $banner,
            'slug' => $slug,
        ]);
        
        $bundle_path = $this->getUniversalPath('public/images/bundles/'.$bundle->id);

        $this->uploadFile($request, 'thumbnail', $bundle_path, 'thumbnail');
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $bundle_path, 'banner') : null;

        $this->successMsg("New Bundle has been created");

        $this->redierctTo('bundle/show/'.$slug);
    }

    public function update(Request $request)
    {
        $bundle_id = $request->input('bundle_id');

        $bundle = Bundle::where('id', $bundle_id)->first();

        $bundle_name = $request->input('bundle_name');
        $price = $request->input('price');
        $thumbnail = $request->hasFile('thumbnail') ? $request->hasFile('thumbnail') : $bundle->thumbnail;
        $banner = $request->hasFile('banner') ? $request->hasFile('banner') : $bundle->banner;
        $slug = $this->slugify($bundle_name);

        // check if thumbnail is uploaded
        if($request->hasFile('thumbnail'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('thumbnail')->getClientOriginalExtension(), "thumbnail image extension is not allowed");

            $thumbnail = 'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
        }

        // check if banner is uploaded
        if($request->hasFile('banner'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('banner')->getClientOriginalExtension(), "Banner image extension is not allowed");

            $banner = 'banner.'.$request->file('banner')->getClientOriginalExtension();
        }

        Bundle::where('id', $bundle_id)->update([
            'name' => $bundle_name,
            'thumbnail' => $thumbnail,
            'banner' => $banner,
            'price' => $price,
            'slug' => $slug,
        ]);

        $bundle_path = $this->getUniversalPath('public/images/bundles/'.$bundle->id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $bundle_path, 'thumbnail') : null;
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $bundle_path, 'banner') : null;

        $this->successMsg("Bundle has been updated");

        $this->redierctTo('bundle/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $bundle_id = $request->input('bundle_id');

        $bundle_path = $this->getUniversalPath('public/images/bundles/'.$bundle_id);

        if(Bundle::where('id', $bundle_id)->delete())
        {
            file_exists($bundle_path) ? $this->deleteDir($bundle_path) : null;

            $this->successMsg("This bundle has been removed");

            $this->redierctTo('bundles');
        }
    }

    public function addNewCourses(Request $request)
    {
        $bundle_id = $request->input('bundle_id');
        $courses = $request->input('courses');
        
        foreach($courses as $course_id)
        {
            BundleCourse::firstOrCreate(['bundle_id' => $bundle_id, 'course_id' => $course_id], [
                'bundle_id' => $bundle_id,
                'course_id' => $course_id,
            ]);
        }

        $this->successMsg("New Courses has been added to this bundle");

        $this->reloadPage();
    }

    public function removeBundleCourse(Request $request)
    {
        $bundle_course_id = $request->input('bundle_course_id');

        if(BundleCourse::where('id', $bundle_course_id)->delete())
        {
            $this->successMsg("The course has been removed from this bundle");
        }
    }

    public function appendNewUsers(Request $request)
    {
        $bundle_id = $request->input('bundle_id');
        $users = $request->input('users');

        foreach($users as $user_id)
        {
            BundleUser::firstOrCreate(['bundle_id' => $bundle_id, 'user_id' => $user_id], [
                'bundle_id' => $bundle_id,
                'user_id' => $user_id,
                'slug' => 'null for now'
            ]);
        }

        $this->successMsg("New User has been added to this bundle");

        $this->reloadPage();
    }

    public function removeBundleuser(Request $request)
    {
        $bundle_user_id = $request->input('bundle_user_id');

        if(BundleUser::where('user_id', $bundle_user_id)->delete())
        {
            $this->successMsg("The user has been removed from this bundle");
        }
    }
}

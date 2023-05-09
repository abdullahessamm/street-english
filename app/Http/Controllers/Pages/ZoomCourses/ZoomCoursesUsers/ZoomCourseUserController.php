<?php

namespace App\Http\Controllers\Pages\ZoomCourses\ZoomCoursesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ZoomCourses\ZoomCourseUser;

class ZoomCourseUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.zoom-courses.users.index');
    }

    public function create()
    {
        return view('pages.zoom-courses.users.create');
    }

    public function show($id)
    {
        $zoomCourseUser = ZoomCourseUser::where('id', $id)->first();
        
        return view('pages.zoom-courses.users.show')->with('zoomCourseUser', $zoomCourseUser);
    }
}

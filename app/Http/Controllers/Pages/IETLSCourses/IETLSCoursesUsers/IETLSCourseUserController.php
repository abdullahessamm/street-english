<?php

namespace App\Http\Controllers\Pages\IETLSCourses\IETLSCoursesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IETLSCourses\IeltsUser;

class IETLSCourseUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.ietls-courses.users.index');
    }

    public function create()
    {
        return view('pages.ietls-courses.users.create');
    }

    public function show($id)
    {
        $ieltsUser = IeltsUser::where('id', $id)->first();
        
        return view('pages.ietls-courses.users.show')->with('ieltsUser', $ieltsUser);
    }
}

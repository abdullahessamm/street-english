<?php

namespace App\Http\Controllers\Coach\Pages\MyBlogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaches\Blogs\CoachPost;
use Illuminate\Support\Facades\Auth;

class MyBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function index()
    {
        $coachPosts = CoachPost::where('coach_id', Auth::guard('coach')->user()->id)->get();

        return view('coach.pages.my-blog.index')->with('coachPosts', $coachPosts);
    }

    public function show($slug)
    {
        $coachPost = CoachPost::where('slug', $slug)->first();

        return view('coach.pages.my-blog.show')->with('coachPost', $coachPost);
    }

    public function create()
    {
        return view('coach.pages.my-blog.create');
    }
}

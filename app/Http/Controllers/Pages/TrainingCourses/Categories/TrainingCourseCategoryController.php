<?php

namespace App\Http\Controllers\Pages\TrainingCourses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TrainingCourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.training-courses.categories.index');
    }
}

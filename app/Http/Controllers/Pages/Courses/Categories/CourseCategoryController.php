<?php

namespace App\Http\Controllers\Pages\Courses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.courses.categories.index');
    }
}

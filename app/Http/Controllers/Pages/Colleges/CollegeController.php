<?php

namespace App\Http\Controllers\Pages\Colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Colleges\College;

class CollegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.colleges.index');
    }

    public function create()
    {
        return view('pages.colleges.create');
    }

    public function show($slug)
    {
        $college = College::where('slug', $slug)->first();

        if($college == null)
        {
            abort(404);
        }

        return view('pages.colleges.show')->with('college', $college);
    }
}

<?php

namespace App\Http\Controllers\Pages\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Students\Student;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.students.index');
    }

    public function create()
    {
        return view('pages.students.create');
    }

    public function show($id)
    {
        $student = Student::where('id', $id)->first();
        
        return view('pages.students.show')->with('student', $student);
    }
}

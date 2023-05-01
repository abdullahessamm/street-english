<?php

namespace App\Http\Controllers\Pages\Sessions\MySessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MySessionController extends Controller
{
    public function index()
    {
        return view('pages.blog.index');
    }

    public function show()
    {
        return view('pages.blog.show');
    }
}

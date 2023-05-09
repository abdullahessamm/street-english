<?php

namespace App\Http\Controllers\Pages\Coaches\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoachCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.coach.categories.index');
    }
}

<?php

namespace App\Http\Controllers\Pages\Blogs\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.blogs.category.index');
    }

    public function create()
    {
        return view('pages.blogs.category.create');
    }
}

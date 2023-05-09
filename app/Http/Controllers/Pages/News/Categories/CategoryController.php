<?php

namespace App\Http\Controllers\Pages\News\Categories;

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
        return view('pages.news.category.index');
    }

    public function create()
    {
        return view('pages.news.category.create');
    }
}

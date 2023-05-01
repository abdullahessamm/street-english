<?php

namespace App\Http\Controllers\Pages\TVShows;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TVShowController extends Controller
{
    public function index()
    {
        return view('pages.tv-show.index');
    }

    public function show()
    {
        return view('pages.tv-show.show');
    }

    public function episode()
    {
        return view('pages.tv-show.episode');
    }
}

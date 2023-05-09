<?php

namespace App\Http\Controllers\Pages\Coaches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaches\CoachCategory;
use App\Models\Coaches\Coach;

class CoachController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('pages.coach.index');
    }

    public function create()
    {
        return view('pages.coach.create');
    }

    public function show($id)
    {
        $coach = Coach::where('id', $id)->first();
        
        $coach == null ? $this->redierctTo('coach/create') : true;

        return view('pages.coach.show')->with('coach', $coach);
    }
}

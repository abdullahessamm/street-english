<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    /**
     * Show the Coach dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('coach.home');
    }
}

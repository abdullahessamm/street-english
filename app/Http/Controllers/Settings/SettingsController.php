<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('settings.index');
    }

    public function email()
    {
        return view('settings.email');
    }

    public function password()
    {
        return view('settings.password');
    }
}
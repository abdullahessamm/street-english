<?php

namespace App\Http\Controllers\Student\MyBundles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bundles\Bundle;
use App\Models\Bundles\BundleUser;
use Illuminate\Support\Facades\Auth;

class MyBundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;

        $myBundles = BundleUser::where('user_id', $user_id)->get();

        return view('student.pages.my-bundles.index')->with('myBundles', $myBundles);
    }

    public function show($slug)
    {
        $myBundle = BundleUser::where('slug', $slug)->first();
        
        return view('student.pages.my-bundles.show')->with('myBundle', $myBundle);
    }
}

<?php

namespace App\Http\Controllers\Student\MyBundles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AjaxMyBundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}

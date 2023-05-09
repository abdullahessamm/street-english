<?php

namespace App\Http\Controllers\Pages\CoachingMemberships;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoachMembership;
use App\Models\WorkWithUsForm;

class CoachingMembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.coaching-membership.index');
    }

    public function show($id)
    {
        $workWithUsForm = WorkWithUsForm::where('id', $id)->first();

        $workWithUsForm == null ? $this->redierctTo('coaching-memberships') : true;

        return view('pages.coaching-membership.show')->with('workWithUsForm', $workWithUsForm);
    }
}

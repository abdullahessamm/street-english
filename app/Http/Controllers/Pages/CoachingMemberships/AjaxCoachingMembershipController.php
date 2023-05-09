<?php

namespace App\Http\Controllers\Pages\CoachingMemberships;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CoachMembership;
use App\Models\WorkWithUsForm;

class AjaxCoachingMembershipController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workWithUsForm = WorkWithUsForm::query();

        return Datatables::of($workWithUsForm)
        ->editColumn('fullname', function ($workWithUsForm) {
            return $workWithUsForm->fullname;
        })
        ->editColumn('email', function ($workWithUsForm) {
            return '<a href="'.route('coaching-membership.show', [$workWithUsForm->id]).'">'.$workWithUsForm->email.'</a>';
        })
        ->editColumn('created_at', function ($workWithUsForm) {
            return date("Y-m-d h:i a", strtotime($workWithUsForm->created_at));
        })
        ->rawColumns(['email'])
        ->make(true);
    }
}

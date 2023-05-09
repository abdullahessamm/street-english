<?php

namespace App\Http\Controllers\Pages\Coaches\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Coaches\CoachCategory;

class AjaxCoachCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $coachCategory = CoachCategory::query();

        return Datatables::of($coachCategory)
        ->editColumn('name', function ($coachCategory) {
            return '<a href="'.route('coach.show', [$coachCategory->id]).'">'.$coachCategory->name.'</a>';
        })
        ->editColumn('coaches', function ($coachCategory) {
            return $coachCategory->coaches->count();
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $coach_category_name = $request->input('coach_category_name');
        $slug = $this->slugify($coach_category_name);

        CoachCategory::firstOrCreate(['slug' => $slug], [
            'name' => $coach_category_name,
            'slug' => $slug,
        ]);

        $this->successMsg("New Coach Category has been created");

        $this->reloadPage();
    }
}

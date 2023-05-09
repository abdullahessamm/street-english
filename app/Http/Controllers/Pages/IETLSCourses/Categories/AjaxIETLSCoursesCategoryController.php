<?php

namespace App\Http\Controllers\Pages\IETLSCourses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\IETLSCourses\IETLSCourseCategory;

class AjaxIETLSCoursesCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $IETLSCourseCategory = IETLSCourseCategory::query();

        return Datatables::of($IETLSCourseCategory)
        ->editColumn('category_name', function ($IETLSCourseCategory) {
            return '<span contenteditable="true" class="updateCategoryName" data-IETLSCourse-category-id="'.$IETLSCourseCategory->id.'">'.$IETLSCourseCategory->category_name.'</span>';
        })
        ->editColumn('delete_category', function ($IETLSCourseCategory) {
            return '<button class="btn btn-danger font-weight-bold deleteIETLSCourseCategory" data-IETLSCourse-category-id="'.$IETLSCourseCategory->id.'">مسح '.$IETLSCourseCategory->category_name.'</button>';
        })
        ->editColumn('created_at', function ($IETLSCourseCategory) {
            return date("Y-m-d h:i:s a", strtotime($IETLSCourseCategory->created_at));
        })
        ->setRowId(function ($IETLSCourseCategory) {
            return 'tr_IETLSCourse_category_'.$IETLSCourseCategory->id;
        })
        ->rawColumns(['category_name', 'delete_category'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $category_name = $request->input('category_name');

        IETLSCourseCategory::firstOrCreate(['category_name' => $category_name], [
            'category_name' => $category_name,
            'slug' => $this->slugify($category_name),
        ]);

        $this->successMsg("تم انشاء فئة جديدة");

        $this->reloadPage();
    }

    public function update(Request $request)
    {
        $IETLSCourse_category_id = $request->input('course_category_id');
        $IETLSCourse_category_name = $request->input('course_category_name');
        
        IETLSCourseCategory::where('id', $IETLSCourse_category_id)->update([
            'category_name' => $IETLSCourse_category_name,
            'slug' => $this->slugify($IETLSCourse_category_name),
        ]);
    }

    public function delete(Request $request)
    {
        $IETLSCourse_category_id = $request->input('course_category_id');
        
        if(IETLSCourseCategory::where('id', $IETLSCourse_category_id)->delete())
        {
            $this->successMsg("تم ازاله هذة الفئة من قاعدة البيانات");

            $this->reloadPage();
        }
    }
}

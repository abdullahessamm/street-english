<?php

namespace App\Http\Controllers\Pages\Courses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Courses\CourseCategory;

class AjaxCourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $CourseCategory = CourseCategory::query();

        return Datatables::of($CourseCategory)
        ->editColumn('category_name', function ($CourseCategory) {
            return '<span contenteditable="true" class="updateCategoryName" data-course-category-id="'.$CourseCategory->id.'">'.$CourseCategory->category_name.'</span>';
        })
        ->editColumn('delete_category', function ($CourseCategory) {
            return '<button class="btn btn-danger font-weight-bold deleteCourseCategory" data-course-category-id="'.$CourseCategory->id.'">Delete this category</button>';
        })
        ->editColumn('created_at', function ($CourseCategory) {
            return date("Y-m-d h:i:s a", strtotime($CourseCategory->created_at));
        })
        ->setRowId(function ($CourseCategory) {
            return 'tr_course_category_'.$CourseCategory->id;
        })
        ->rawColumns(['category_name', 'delete_category'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $category_name = $request->input('category_name');

        CourseCategory::firstOrCreate(['category_name' => $category_name], [
            'category_name' => $category_name,
            'slug' => $this->slugify($category_name),
        ]);

        $this->successMsg("New Course Category has been in our database");
    }

    public function update(Request $request)
    {
        $course_category_id = $request->input('course_category_id');
        $course_category_name = $request->input('course_category_name');

        CourseCategory::where('id', $course_category_id)->update([
            'category_name' => $course_category_name,
            'slug' => $this->slugify($course_category_name),
        ]);
    }

    public function delete(Request $request)
    {
        $course_category_id = $request->input('course_category_id');

        if(CourseCategory::where('id', $course_category_id)->delete())
        {
            $this->successMsg("This course category has been removed from our database");
        }
    }
}

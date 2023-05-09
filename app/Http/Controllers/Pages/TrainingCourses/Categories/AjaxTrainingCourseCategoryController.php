<?php

namespace App\Http\Controllers\Pages\TrainingCourses\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\TrainingCourses\TrainingCourseCategory;

class AjaxTrainingCourseCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $trainingCourseCategory = TrainingCourseCategory::query();

        return Datatables::of($trainingCourseCategory)
        ->editColumn('category_name', function ($trainingCourseCategory) {
            return '<span contenteditable="true" class="updateCategoryName" data-course-category-id="'.$trainingCourseCategory->id.'">'.$trainingCourseCategory->category_name.'</span>';
        })
        ->editColumn('delete_category', function ($trainingCourseCategory) {
            return '<button class="btn btn-danger font-weight-bold deleteTrainingCourseCategory" data-course-category-id="'.$trainingCourseCategory->id.'">Delete this category</button>';
        })
        ->editColumn('created_at', function ($trainingCourseCategory) {
            return date("Y-m-d h:i:s a", strtotime($trainingCourseCategory->created_at));
        })
        ->setRowId(function ($trainingCourseCategory) {
            return 'tr_course_category_'.$trainingCourseCategory->id;
        })
        ->rawColumns(['category_name', 'delete_category'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $category_name = $request->input('category_name');

        TrainingCourseCategory::firstOrCreate(['category_name' => $category_name], [
            'category_name' => $category_name,
            'slug' => $this->slugify($category_name),
        ]);

        $this->successMsg("New Course Category has been in our database");
    }

    public function update(Request $request)
    {
        $course_category_id = $request->input('course_category_id');
        $course_category_name = $request->input('course_category_name');

        TrainingCourseCategory::where('id', $course_category_id)->update([
            'category_name' => $course_category_name,
            'slug' => $this->slugify($course_category_name),
        ]);
    }

    public function delete(Request $request)
    {
        $course_category_id = $request->input('course_category_id');

        if(TrainingCourseCategory::where('id', $course_category_id)->delete())
        {
            $this->successMsg("This course category has been removed from our database");
        }
    }
}

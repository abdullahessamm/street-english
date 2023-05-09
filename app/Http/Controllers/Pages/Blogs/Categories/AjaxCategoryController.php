<?php

namespace App\Http\Controllers\Pages\Blogs\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Blogs\Category;

class AjaxCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $category = Category::query();

        return Datatables::of($category)
        ->editColumn('title', function ($category) {
            return $category->name;
        })
        ->editColumn('posts', function ($category) {
            return $category->posts->count();
        })
        ->editColumn('delete', function ($category) {
            return '<button class="btn btn-danger btn-sm deleteCategory" data-category-id="'.$category->id.'">Delete this category</button>';
        })
        ->rawColumns(['delete'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $category_name = $request->input('category_name');
        $slug = $this->slugify($category_name);

        Category::firstOrCreate(['name' => $category_name], [
            'name' => $category_name,
            'slug' => $slug,
        ]);

        echo $this->successMsg("New category has been added in our database");
    }

    public function delete(Request $request)
    {
        $category_id = $request->input('category_id');

        if(Category::where('id', $category_id)->delete())
        {
            echo $this->successMsg("This category has been removed from our database");
        }
    }
}

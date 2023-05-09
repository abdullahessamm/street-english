<?php

namespace App\Http\Controllers\Pages\Colleges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Colleges\College;

class AjaxCollegeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $college = College::query();

        return Datatables::of($college)
        ->editColumn('college_name', function ($college) {
            return '<a href="'.route('college.show', [$college->slug]).'">'.$college->college_name.'</a>';
        })
        ->editColumn('created_at', function ($college) {
            return date("Y-m-d h:i:s a", strtotime($college->created_at));
        })
        ->rawColumns(['college_name'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $college_name = $request->input('college_name');
        $short_description = $request->input('short_description');
        $content = $request->input('content');
        $thumbnail = 'thumbnail.'.$request->file('image')->getClientOriginalExtension();
        $cover = 'cover.'.$request->file('cover')->getClientOriginalExtension();
        $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        $slug = $this->slugify($college_name);

        if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('thumbnail')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("College thumnail image extension is not allowed");
            die();
        }

        if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('cover')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("College cover image extension is not allowed");
            die();
        } 

        if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('image')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("College image extension is not allowed");
            die();
        }

        $data = [
            'college_name' => $college_name,
            'short_description' => $short_description,
            'content' => $content,
            'thumbnail' => $thumbnail,
            'cover' => $cover,
            'image' => $image,
            'slug' => $slug,
        ];
        
        $college = College::firstOrCreate(['college_name' => $college_name], $data);

        if($college)
        {
            $college_path = $this->getUniversalPath('public/images/colleges/'.$college->id);
        
            $this->uploadFile($request, 'cover', $college_path, 'cover');
            $this->uploadFile($request, 'image', $college_path, 'image');

            echo $this->successMsg("New college has been added in our database");
            $this->redierctTo('college/show/'.$slug);
        }
    }

    public function update(Request $request)
    {
        $college_id = $request->input('college_id');

        $college = College::where('id', $college_id)->first();

        $college_name = $request->input('college_name');
        $short_description = $request->input('short_description');
        $content = $request->input('content');
        $slug = $this->slugify($college_name);

        if($request->hasFile('thumbnail'))
        {
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('thumbnail')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("College thumnail image extension is not allowed");
                die();
            }

            $thumbnail = 'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
        }
        else
        {
            $thumbnail = $college->thumbnail;
        }

        if($request->hasFile('cover'))
        {
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('cover')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("College cover image extension is not allowed");
                die();
            }

            $cover = 'cover.'.$request->file('cover')->getClientOriginalExtension();
        }
        else
        {
            $cover = $college->cover;
        }

        if($request->hasFile('image'))
        {
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('image')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("College image extension is not allowed");
                die();
            }

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        }
        else
        {
            $image = $college->image;
        }

        College::where('id', $college_id)->update([
            'college_name' => $college_name,
            'short_description' => $short_description,
            'content' => $content,
            'thumbnail' => $thumbnail,
            'image' => $image,
            'cover' => $cover,
            'slug' => $slug,
        ]);

        $college_path = $this->getUniversalPath('public/images/colleges/'.$college_id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $college_path, 'thumbnail') : false;
        $request->hasFile('cover') ? $this->uploadFile($request, 'cover', $college_path, 'cover') : false;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $college_path, 'image') : false;

        echo $this->successMsg("College data has been updated");
        $this->redierctTo('college/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $college_id = $request->input('college_id');

        if(College::where('id', $college_id)->delete())
        {
            $college_path = $this->getUniversalPath('public/images/colleges/'.$college_id);

            $this->deleteDir($college_path);

            echo $this->successMsg("This college has been removed from our database");
            $this->redierctTo('colleges');
        }
    }
}

<?php

namespace App\Http\Controllers\Pages\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs\Category;
use App\Models\Blogs\Post;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.blogs.index');
    }

    public function create()
    {
        $categories = Category::get();

        return view('pages.blogs.create')->with('categories', $categories);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $categories = Category::get();

        if($post == null)
        {
            abort(404);
        }

        return view('pages.blogs.show')->with('post', $post)->with('categories', $categories);
    }

    public function previewMediaType(Request $request)
    {
        $type = $request->input('type');

        switch($type)
        {
            case 'image':
                return view('pages.blogs.media-type.image');
            break;
                
            case 'video':
                return view('pages.blogs.media-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }
}

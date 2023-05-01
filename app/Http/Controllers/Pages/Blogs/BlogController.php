<?php

namespace App\Http\Controllers\Pages\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blogs\Post;
use App\Models\Blogs\Category;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');

        $postCategory = Category::where('slug', $category)->first();

        if($category == null){

            $blogs = Post::get();
            
        }else{
            
            $blogs = Post::where('post_category_id', $postCategory->id)->get();
        }

        $recentBlogs = Post::orderBy('created_at', 'desc')->take(5)->get();
        $categories = Category::all();

        return view('pages.blog.index')
        ->with('blogs', $blogs)
        ->with('recentBlogs', $recentBlogs)
        ->with('categories', $categories);
    }

    public function show($slug)
    {
        $blog = Post::where('slug', $slug)->first();
        $recentPosts = Post::where('id', '!=', $blog->id)->take(5)->get();

        return view('pages.blog.show')
        ->with('blog', $blog)
        ->with('recentPosts', $recentPosts);
    }
}

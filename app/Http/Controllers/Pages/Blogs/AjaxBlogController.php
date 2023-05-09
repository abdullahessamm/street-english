<?php

namespace App\Http\Controllers\Pages\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Blogs\Post;

class AjaxBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $post = Post::query();

        return Datatables::of($post)
        ->editColumn('title', function ($post) {
            return '<a href="'.route('blog.show', [$post->slug]).'">'.$post->title.'</a>';
        })
        ->editColumn('posted_at', function ($post) {
            return date("Y-m-d", strtotime($post->posted_at));
        })
        ->editColumn('created_at', function ($post) {
            return date("Y-m-d h:i:s a", strtotime($post->created_at));
        })
        ->rawColumns(['title'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $title = $request->input('title');
        $short_description = $request->input('short_description');
        $content = $request->input('content');
        $media_type = $request->input('choose_media');
        $backgroundCover = $request->file('background_cover');
        $image = $media_type == 'image' ? $request->file('image') : null;
        $video_url = $media_type == 'video' ? $request->input('video') : null;
        $posted_at = $request->input('posted_at') == null ? date("Y-m-d") : $request->input('posted_at');
        $slug = $this->slugify($title);
        $category_id = $request->input('category');

        if($media_type == 'image' && $request->hasFile('image'))
        {
            // check image extension
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $image->getClientOriginalExtension()))
            {
                echo $this->errorMsg("Image Extension is not allowed");
                die();
            }
        }
        else
        {
            $image = null;
        }

        if($media_type == 'video' && $video_url != null)
        {
            $this->checkIfUrlIsYoutube($video_url);

            $video = $this->parseYouTubeURL($video_url);
        }
        else
        {
            $video = null;
        }

        $data = [
            'title' => $title,
            'short_description' => $short_description,
            'content' => $content,
            'media_type' => $media_type,
            'banner' => $request->hasFile('background_cover') ? 'cover.'.$backgroundCover->getClientOriginalExtension() : null,
            'image' => $image == null ? null : 'image.'.$image->getClientOriginalExtension(),
            'video' => $video,
            'posted_at' => $posted_at,
            'slug' => $slug,
            'post_category_id' => $category_id,
        ];
        
        $Post = Post::firstOrCreate(['title' => $title], $data);
        
        if($Post)
        {
            $post_path = $this->getUniversalPath('public/public/uploads/blogs/'.$Post->id);
            
            $request->hasFile('background_cover') ? $this->uploadFile($request, 'background_cover', $post_path, 'cover') : false;
            
            if($image != null)
            {
                $this->uploadFile($request, 'image', $post_path, 'image');
            }

            echo $this->successMsg("New post has been created in our database");
            $this->redierctTo('blog/show/'.$slug);
        }
    }

    public function update(Request $request)
    {
        $post_id = $request->input('post_id');

        $post = Post::where('id', $post_id)->first();

        $title = $request->input('title');
        $short_description = $request->input('short_description');
        $content = $request->input('content');
        $media_type = $request->input('choose_media') == 'none' ? $post->media_type : $request->input('choose_media');
        $backgroundCover = $request->file('background_cover');
        $posted_at = $request->input('posted_at') == null ? date("Y-m-d") : $request->input('posted_at');
        $slug = $this->slugify($title);
        $category_id = $request->input('category');

        if($media_type == 'image' && $request->hasFile('image'))
        {
            // check image extension
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('image')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("Image Extension is not allowed");
                die();
            }

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        }
        else
        {
            $image = $post->image;
        }

        if($media_type == 'video' && $request->input('video') != null)
        {
            $this->checkIfUrlIsYoutube($request->input('video'));

            $video = $this->parseYouTubeURL($request->input('video'));
        }
        else
        {
            $video = $post->video;
        }

        $post_path = $this->getUniversalPath('public/public/uploads/blogs/'.$post->id);
        
        if($request->hasFile('background_cover'))
        {
            $background_cover = 'cover.'.$backgroundCover->getClientOriginalExtension();
            $this->uploadFile($request, 'background_cover', $post_path, 'cover');
        }
        else
        {
            $background_cover = $post->background_cover;
        }

        Post::where('id', $post_id)->update([
            'title' => $title,
            'short_description' => $short_description,
            'content' => $content,
            'media_type' => $media_type,
            'banner' => $background_cover,
            'image' => $image,
            'video' => $video,
            'posted_at' => $posted_at,
            'slug' => $slug,
            'post_category_id' => $category_id,
        ]);

        echo $this->successMsg("New post has been created in our database");
        $this->redierctTo('blog/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $post_id = $request->input('post_id');

        $post_path = $this->getUniversalPath('public/public/uploads/blogs/'.$post_id);

        if(Post::where('id', $post_id)->delete())
        {
            $this->deleteDir($post_path);
            $this->successMsg("This post has been removed");
            $this->redierctTo('blogs');
        }
    }
}

<?php

namespace App\Http\Controllers\Coach\Pages\MyBlogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Coaches\Blogs\CoachPost;

class AjaxMyBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function create(Request $request)
    {
        $coach_id = Auth::guard('coach')->user()->id;

        $title = $request->input('title');
        $short_description = $request->input('short_description');
        $content = $request->input('content');
        $banner = null;
        $choose_media = $request->input('choose_media');
        $image = null;
        $video_url = $request->input('video');
        $posted_at = $request->input('posted_at') == null ? date("Y-m-d") : $request->input('posted_at');
        $slug = $this->slugify($title);

        // check if banner is uploaded
        if($request->hasFile('banner'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('banner')->getClientOriginalExtension(), "Banner image extension is not allowed");

            $banner = 'banner.'.$request->file('banner')->getClientOriginalExtension();
        }

        // check if intro image is uploaded
        if($request->hasFile('image'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension(), "Intro image extension is not allowed");

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        }

        // check if intro video url is a youtube link
        if($video_url != null)
        {
            $this->checkIfUrlIsYoutube($video_url, 'Video intro must be a youtube link');
            $video_url = $this->parseYouTubeURL($video_url);
        }

        $data = [
            'coach_id' => $coach_id,
            'title' => $title,
            'short_description' => $short_description,
            'content' => $content,
            'banner' => $banner,
            'media_type' => $choose_media,
            'image' => $image,
            'video_url' => $video_url,
            'posted_at' => $posted_at,
            'slug' => $slug,
        ];

        $coachPost = CoachPost::firstOrCreate(['slug' => $slug], $data);

        $coach_blog_path = $this->getUniversalPath('public/images/coaches/'.$coach_id.'/blogs/'.$coachPost->id);

        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $coach_blog_path, 'banner') : null;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $coach_blog_path, 'image') : null;

        $this->successMsg("لقد تم انشاء بلوج جديد");

        $this->redierctTo('coach/my-blog/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $coach_id = Auth::guard('coach')->user()->id;

        $coach_blog_id = $request->input('coach_blog_id');

        if(CoachPost::where('id', $coach_blog_id)->delete())
        {
            $coach_blog_path = $this->getUniversalPath('public/images/coaches/'.$coach_id.'/blogs/'.$coach_blog_id);

            file_exists($coach_blog_path) ? $this->deleteDir($coach_blog_path) : null;

            $this->successMsg("تم مسح البلوج");

            $this->redierctTo('coach/my-blogs');
        }
    }

    public function previewCurrentIntroMedia(Request $request)
    {
        $coach_id = Auth::guard('coach')->user()->id;

        $my_blog_id = $request->input('data')['my_blog_id'];

        $myBlog = CoachPost::where('id', $my_blog_id)->first();

        switch($myBlog->media_type)
        {
            case 'image':
                echo '
                <img src="'.asset('images/coaches/'.$coach_id.'/blogs/'.$myBlog->id.'/'.$myBlog->image).'" class="img-fluid">
                ';
            break;
                
            case 'video':
                echo '
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$myBlog->video_url.'?rel=0" allowfullscreen></iframe>
                </div>
                ';
            break;
        }        
    }

    public function previewMediaType(Request $request)
    {
        $media_type = $request->input('data')['media_type'];

        switch($media_type)
        {
            case 'image':
                return view('coach.pages.my-blog.media-intro-type.image');
            break;
                
            case 'video':
                return view('coach.pages.my-blog.media-intro-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }
}

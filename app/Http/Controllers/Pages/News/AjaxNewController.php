<?php

namespace App\Http\Controllers\Pages\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\News\News;

class AjaxNewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $newsArticle = News::query();

        return Datatables::of($newsArticle)
        ->editColumn('title', function ($newsArticle) {
            return '<a href="'.route('news-article.show', [$newsArticle->slug]).'">'.$newsArticle->title.'</a>';
        })
        ->editColumn('posted_at', function ($newsArticle) {
            return date("Y-m-d", strtotime($newsArticle->posted_at));
        })
        ->editColumn('created_at', function ($newsArticle) {
            return date("Y-m-d h:i:s a", strtotime($newsArticle->created_at));
        })
        ->rawColumns(['title'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $news_category_id = $request->input('news_category_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $media_type = $request->input('choose_media');
        $banner = $request->file('banner');
        $image = $media_type == 'image' ? $request->file('image') : null;
        $video_url = $media_type == 'video' ? $request->input('video') : null;
        $posted_at = $request->input('posted_at') == null ? date("Y-m-d") : $request->input('posted_at');
        $slug = $this->slugify($title);

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
            'news_category_id' => $news_category_id,
            'title' => $title,
            'content' => $content,
            'media_type' => $media_type,
            'banner' => $request->hasFile('banner') ? 'banner.'.$banner->getClientOriginalExtension() : null,
            'image' => $image == null ? null : 'image.'.$image->getClientOriginalExtension(),
            'video' => $video,
            'posted_at' => $posted_at,
            'slug' => $slug,
        ];

        $newsArticle = News::firstOrCreate(['title' => $title], $data);
        
        if($newsArticle)
        {
            $news_articles_path = $this->getUniversalPath('public/images/news-articles/'.$newsArticle->id);
            
            $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $news_articles_path, 'banner') : false;
            
            if($image != null)
            {
                $this->uploadFile($request, 'image', $news_articles_path, 'image');
            }

            echo $this->successMsg("New post has been created in our database");
            $this->redierctTo('news-article/show/'.$slug);
        }
    }

    public function update(Request $request)
    {
        $article_id = $request->input('article_id');

        $post = News::where('id', $article_id)->first();

        $news_category_id = $request->input('news_category_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $media_type = $request->input('choose_media');
        $banner = $request->file('banner');
        $posted_at = $request->input('posted_at') == null ? date("Y-m-d") : $request->input('posted_at');
        $slug = $this->slugify($title);

        $news_articles_path = $this->getUniversalPath('public/images/news-articles/'.$post->id);

        if($media_type == 'image' && $request->hasFile('image'))
        {
            // check image extension
            if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $request->file('image')->getClientOriginalExtension()))
            {
                echo $this->errorMsg("Image Extension is not allowed");
                die();
            }

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
            $this->uploadFile($request, 'image', $news_articles_path, 'image');
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
        
        if($request->hasFile('banner'))
        {
            $this->uploadFile($request, 'banner', $news_articles_path, 'cover');

            $banner = 'banner.'.$banner->getClientOriginalExtension();
            $this->uploadFile($request, 'banner', $news_articles_path, 'banner');
        }
        else
        {
            $banner = $post->banner;
        }

        if($media_type == 'none')
        {
            $image = null;
            $banner = null;
            $video = null;
        }

        News::where('id', $article_id)->update([
            'news_category_id' => $news_category_id,
            'title' => $title,
            'content' => $content,
            'media_type' => $media_type,
            'banner' => $banner,
            'image' => $image,
            'video' => $video,
            'posted_at' => $posted_at,
            'slug' => $slug,
        ]);

        echo $this->successMsg("New post has been created in our database");
        $this->redierctTo('news-article/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $article_id = $request->input('article_id');

        $news_articles_path = $this->getUniversalPath('public/images/news-articles/'.$article_id);

        if(News::where('id', $article_id)->delete())
        {
            file_exists($news_articles_path) ? $this->deleteDir($news_articles_path) : false;
            $this->successMsg("This post has been removed");
            $this->redierctTo('news');
        }
    }
}

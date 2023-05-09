<?php

namespace App\Http\Controllers\Pages\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News\News;
use App\Models\News\LatestNew;
use App\Models\News\NewsCategory;

class NewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('pages.news.index');
    }

    public function create()
    {
        $news_categories = NewsCategory::get();

        if($news_categories->count() == 0)
        {
            $this->redierctTo('news-article/category/create');
        }

        return view('pages.news.create')->with('news_categories', $news_categories);
    }

    public function show($slug)
    {
        $news_article = News::where('slug', $slug)->first();
        $news_categories = NewsCategory::get();

        if($news_article == null)
        {
            abort(404);
        }

        return view('pages.news.show')
        ->with('news_article', $news_article)
        ->with('news_categories', $news_categories);
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
    
    public function previewMediaTypeToUpdate(Request $request)
    {
        $media_type = $request->input('data')['media_type'];
        $article_id = $request->input('data')['article_id'];
        $current_media_type = $media_type == 'current_media' ? $request->input('data')['current_media_type'] : null;

        $newsArticle = News::where('id', $article_id)->first();

        if($current_media_type != null)
        {
            switch ($current_media_type)
            {
                case 'image':
                    echo '
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="image-media-type">
                            Current Image
                        </label>
                        <div class="col-md-9">
                            <img src="'.config('app.main_url').'/images/news-articles/'.$newsArticle->id.'/'.$newsArticle->image.'" class="img-fluid">
                        </div>
                    </div>
                    ';
                break;

                case 'video':
                    echo '
                    <div class="form-group row">
                        <label class="col-md-3 label-control" for="image-media-type">
                            Current Youtube Video
                        </label>
                        <div class="col-md-9">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$newsArticle->video.'?rel=0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                    ';
                break;

                case 'none':
                    echo "";
                break;
            }
        }

        switch($media_type)
        {
            case 'image':
                return view('pages.news.media-type.image');
            break;
                
            case 'video':
                return view('pages.news.media-type.video');
            break;

            case 'none':
                return '';
            break;
            
            case 'current_media':

            break;
        }
    }
}

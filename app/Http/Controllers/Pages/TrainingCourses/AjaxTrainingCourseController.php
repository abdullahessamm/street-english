<?php

namespace App\Http\Controllers\Pages\TrainingCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;
use App\Models\TrainingCourses\TrainingCourse;
use App\Models\TrainingCourses\TrainingCourseContent;
use App\Models\TrainingCourses\TrainingCourseInstructor;

class AjaxTrainingCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $trainingCourse = TrainingCourse::query();

        return Datatables::of($trainingCourse)
        ->editColumn('name', function ($trainingCourse) {
            return '<a href="'.route('training-course.show', [$trainingCourse->slug]).'">'.$trainingCourse->name.'</a>';
        })
        ->editColumn('created_at', function ($trainingCourse) {
            return date("Y-m-d h:i:s a", strtotime($trainingCourse->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $training_course_name = $request->input('training_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $training_course_category_id = $request->input('training_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $thumbnail = $request->file('thumbnail');
        $banner = null;
        $choose_media = $request->input('choose_media');
        $image = null;
        $video_url = $request->input('video');
        $instructors = $request->input('coaches') != null ? $request->input('coaches') : null;
        $date = $request->input('date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $map = $request->input('map');
        $slug = $this->slugify($training_course_name);
        
        /*// check if training hasn't any previous dates
        if($date < Carbon::today()->toDateString())
        {
            echo $this->errorMsg("You can't choose previous dates for the training course, please choose another date");
            die();
        }

        // check if training date is not today
        if(Carbon::today()->toDateString() == $date)
        {
            echo $this->errorMsg("Training Course date can't be today, please choose another date");
            die();
        }*/
        
        // check if at least one instructor choosen
        if($instructors == null)
        {
            $this->errorMsg("You must choose at least one instructor");
        }

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

        // check if thumbnail extension is allowed
        $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('thumbnail')->getClientOriginalExtension(), "Thumbnail image extension is not allowed");

        // check if intro video url is a youtube link
        if($video_url != null)
        {
            $this->checkIfUrlIsYoutube($video_url, 'Video intro must be a youtube link');
            $video_url = $this->parseYouTubeURL($video_url);
        }

        $data = [
            'training_course_category_id' => $training_course_category_id,
            'name' => $training_course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language, 
            'price' => $price, 
            'discount' => $discount, 
            'media_intro' => $choose_media, 
            'video_url' => $video_url, 
            'image' => $image, 
            'banner' => $banner, 
            'thumbnail' => 'thumbnail.'.$thumbnail->getClientOriginalExtension(), 
            'description' => $description,
            'map' => $map,
            'slug' => $slug,
        ];

        // upload course data
        $trainingCourse = TrainingCourse::firstOrCreate(['name' => $training_course_name], $data);

        foreach($instructors as $instructor)
        {
            $TrainingCourseInstructor = new TrainingCourseInstructor();
            $TrainingCourseInstructor->coach_id = $instructor;
            $TrainingCourseInstructor->training_course_id = $trainingCourse->id;
            $TrainingCourseInstructor->save();
        }

        $training_course_path = $this->getUniversalPath('public/images/training-courses/'.$trainingCourse->id);

        $this->uploadFile($request, 'thumbnail', $training_course_path, 'thumbnail');
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $training_course_path, 'banner') : null;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $training_course_path, 'image') : null;

        $this->successMsg("New online course has been added in our database");

        $this->redierctTo('training-course/show/'.$slug);
    }

    public function update(Request $request)
    {
        $training_course_id = $request->input('training_course_id');

        $trainingCourse = TrainingCourse::where('id', $training_course_id)->first();

        $training_course_name = $request->input('training_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $training_course_category_id = $request->input('training_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $choose_media = $request->input('choose_media') == 'none' ? $trainingCourse->media_intro : $request->input('choose_media');
        $video_url = $request->input('video');
        $date = $request->input('date');
        $start_time = $request->input('start_time');
        $end_time = $request->input('end_time');
        $map = $request->input('map');
        $slug = $this->slugify($training_course_name);

        // check if training hasn't any previous dates
        if($date < Carbon::today()->toDateString())
        {
            echo $this->errorMsg("You can't choose previous dates for the training course, please choose another date");
            die();
        }

        // check if training date is not today
        if(Carbon::today()->toDateString() == $date)
        {
            echo $this->errorMsg("Training Course date can't be today, please choose another date");
            die();
        }

        // check if thumbnail extension is allowed
        if($request->hasFile('thumbnail'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('thumbnail')->getClientOriginalExtension(), "Thumbnail image extension is not allowed");
            
            $thumbnail = 'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
        }
        else
        {
            $thumbnail = $trainingCourse->thumbnail;
        }

        // check if banner is uploaded
        if($request->hasFile('banner'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('banner')->getClientOriginalExtension(), "Banner image extension is not allowed");

            $banner = 'banner.'.$request->file('banner')->getClientOriginalExtension();
        }
        else
        {
            $banner = $trainingCourse->banner;
        }

        // check if intro image is uploaded
        if($request->hasFile('image'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension(), "Intro image extension is not allowed");

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        }
        else
        {
            $image = $trainingCourse->image;
        }

        // check if intro video url is a youtube link
        if($video_url != null)
        {
            $this->checkIfUrlIsYoutube($video_url, 'Video intro must be a youtube link');
            $video_url = $this->parseYouTubeURL($video_url);

            $image = null;
        }
        else
        {
            $video_url = $trainingCourse->video_url;
        }

        $training_course_path = $this->getUniversalPath('public/images/training-courses/'.$trainingCourse->id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $training_course_path, 'thumbnail') : false;
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $training_course_path, 'banner') : false;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $training_course_path, 'image') : false;
    
        TrainingCourse::where('id', $training_course_id)->update([
            'name' => $training_course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language,
            'training_course_category_id' => $training_course_category_id, 
            'price' => $price, 
            'discount' => $discount, 
            'media_intro' => $choose_media, 
            'video_url' => $video_url, 
            'image' => $image, 
            'banner' => $banner, 
            'thumbnail' => $thumbnail,
            'description' => $description,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'map' => $map,
            'slug' => $slug,
        ]);

        $this->successMsg("Course : ".$trainingCourse->name." has been updated");

        $this->redierctTo('training-course/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $training_course_id = $request->input('training_course_id');

        $training_course_images_path = $this->getUniversalPath('public/images/training-courses/'.$training_course_id);

        if(TrainingCourse::where('id', $training_course_id)->delete())
        {
            $this->deleteDir($training_course_images_path);
        }

        $this->successMsg("This course has been removed");
        $this->redierctTo('training-courses');
    }

    public function createContent(Request $request)
    {
        $training_course_id = $request->input('training_course_id');
        $content_name = $request->input('content_name');
        $description = $request->input('description');

        TrainingCourseContent::create([
            'training_course_id' => $training_course_id,
            'title' => $content_name,
            'description' => $description,
        ]);
        
        $this->successMsg("New content has been added to this course");

        $this->reloadPage();
    }

    public function updateContentTitle(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_title = $request->input('content_title');

        TrainingCourseContent::where('id', $content_id)->update([
            'title' => $content_title,
        ]);
    }
    
    public function updateContentDescription(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_description = $request->input('content_description');

        TrainingCourseContent::where('id', $content_id)->update([
            'description' => $content_description,
        ]);
    }

    public function deleteContent(Request $request)
    {
        $content_id = $request->input('content_id');
        
        if(TrainingCourseContent::where('id', $content_id)->delete())
        {
            $this->successMsg("This content has been removed from this course");

            $this->reloadPage();
        }
    }

    public function previewMediaType(Request $request)
    {
        $type = $request->input('type');

        switch($type)
        {
            case 'image':
                return view('pages.training-courses.media-intro-type.image');
            break;
                
            case 'video':
                return view('pages.training-courses.media-intro-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }
}

<?php

namespace App\Http\Controllers\Coach\Pages\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OnlineCourses\OnlineCourseInstructor;
use App\Models\OnlineCourses\OnlineCourse;
use App\Models\OnlineCourses\OnlineCourseContent;
use App\Models\OnlineCourses\OnlineCourseLesson;

class AjaxMyCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('coach.auth:coach');
    }

    public function create(Request $request)
    {
        $coach_id = Auth::guard('coach')->user()->id;

        $online_course_name = $request->input('online_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $online_course_category_id = $request->input('online_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $thumbnail = $request->file('thumbnail');
        $banner = null;
        $choose_media = $request->input('choose_media');
        $image = null;
        $video_url = $request->input('video');
        $slug = $this->slugify($online_course_name);

        // check if course category is selected
        $online_course_category_id == null ? $this->errorMsg("من فضلك قم باختيار فئة الدورة التدريبية") : true;

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
            'online_course_category_id' => $online_course_category_id,
            'name' => $online_course_name, 
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
            'slug' => $slug,
        ];

        // upload course data
        $onlineCourse = OnlineCourse::firstOrCreate(['name' => $online_course_name], $data);

        OnlineCourseInstructor::firstOrCreate(['coach_id' => $coach_id, 'online_course_id' => $onlineCourse->id], [
            'coach_id' => $coach_id, 
            'online_course_id' => $onlineCourse->id,
        ]);

        $online_course_path = $this->getUniversalPath('public/images/online-courses/'.$onlineCourse->id);

        $this->uploadFile($request, 'thumbnail', $online_course_path, 'thumbnail');
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $online_course_path, 'banner') : null;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $online_course_path, 'image') : null;

        $this->successMsg("لقد تم انشاء دورة جديدة");

        $this->redierctTo('coach/my-course/show/'.$slug);
    }

    public function update(Request $request)
    {
        $online_course_id = $request->input('online_course_id');

        $onlineCourse = OnlineCourse::where('id', $online_course_id)->first();

        $online_course_name = $request->input('online_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $online_course_category_id = $request->input('online_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $choose_media = $request->input('choose_media') == 'none' ? $onlineCourse->media_intro : $request->input('choose_media');
        $video_url = $request->input('video');
        $slug = $this->slugify($online_course_name);
        
        // check if thumbnail extension is allowed
        if($request->hasFile('thumbnail'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('thumbnail')->getClientOriginalExtension(), "Thumbnail image extension is not allowed");
            
            $thumbnail = 'thumbnail.'.$request->file('thumbnail')->getClientOriginalExtension();
        }
        else
        {
            $thumbnail = $onlineCourse->thumbnail;
        }

        // check if banner is uploaded
        if($request->hasFile('banner'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('banner')->getClientOriginalExtension(), "Banner image extension is not allowed");

            $banner = 'banner.'.$request->file('banner')->getClientOriginalExtension();
        }
        else
        {
            $banner = $onlineCourse->banner;
        }

        // check if intro image is uploaded
        if($request->hasFile('image'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension(), "Intro image extension is not allowed");

            $image = 'image.'.$request->file('image')->getClientOriginalExtension();
        }
        else
        {
            $image = $onlineCourse->image;
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
            $video_url = $onlineCourse->video_url;
        }

        $online_course_path = $this->getUniversalPath('public/images/online-courses/'.$onlineCourse->id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $online_course_path, 'thumbnail') : false;
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $online_course_path, 'banner') : false;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $online_course_path, 'image') : false;
    
        OnlineCourse::where('id', $online_course_id)->update([
            'name' => $online_course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language,
            'online_course_category_id' => $online_course_category_id, 
            'price' => $price, 
            'discount' => $discount, 
            'media_intro' => $choose_media, 
            'video_url' => $video_url, 
            'image' => $image, 
            'banner' => $banner, 
            'thumbnail' => $thumbnail,
            'description' => $description,
            'slug' => $slug,
        ]);

        $this->successMsg("تم تحديث الدورة : ".$onlineCourse->name." بنجاح");

        $this->redierctTo('coach/my-course/show/'.$slug);
    }

    public function delete(Request $request)
    {
        $my_course_id = $request->input('my_course_id');

        $online_course_images_path = $this->getUniversalPath('public/images/online-courses/'.$my_course_id);

        if(OnlineCourse::where('id', $my_course_id)->delete())
        {
            $this->deleteDir($online_course_images_path);
        }

        $this->successMsg("تم ازاله هذا الكورس");
        $this->redierctTo('coach/my-courses');
    }

    public function createContent(Request $request)
    {
        $online_course_id = $request->input('online_course_id');
        $content_name = $request->input('content_name');
        $description = $request->input('description');

        OnlineCourseContent::create([
            'online_course_id' => $online_course_id,
            'title' => $content_name,
            'description' => $description,
        ]);
        
        $this->successMsg("تم انشاء محتوي تدريبي");

        $this->reloadPage();
    }

    public function updateContentTitle(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_title = $request->input('content_title');

        OnlineCourseContent::where('id', $content_id)->update([
            'title' => $content_title,
        ]);
    }

    public function updateContentDescription(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_description = $request->input('content_description');

        OnlineCourseContent::where('id', $content_id)->update([
            'description' => $content_description,
        ]);
    }

    public function deleteContent(Request $request)
    {
        $content_id = $request->input('content_id');

        $courseContent = OnlineCourseContent::where('id', $content_id)->first();

        if($courseContent->delete())
        {
            $this->successMsg("تمت ازاله هذا المحتوي من الدورة");

            $this->reloadPage();
        }
    }

    public function createLesson(Request $request)
    {
        $course_id = $request->input('course_id');
        $content_id = $request->input('content_id');

        $lessons = $request->input('lessons');

        for($i = 0; $i < count($lessons); $i++)
        {
            $lesson_title = $lessons[$i]['lesson_title'];
            $video_type = $lessons[$i]['video_type'];
            $video_description = $lessons[$i]['video_description'];
            
            if($video_type == 'vimeo')
            {
                $video_url = $this->parseVimeoURL($lessons[$i]['video_url']);
            }

            if($video_type == 'youtube')
            {
                $video_url = $this->parseYouTubeURL($lessons[$i]['video_url']);
            }

            if($video_type == 'drive')
            {
                $video_url = $lessons[$i]['video_url'];
            }

            $slug = md5(uniqid());

            OnlineCourseLesson::create([
                'online_course_content_id' => $content_id,
                'title' => $lesson_title,
                'video_url' => $video_url,
                'video_type' => $video_type,
                'video_description' => $video_description,
                'slug' => $slug,
            ]);
        }

        $sucess_msg = count($lessons) > 1 ? 'تم اضافة دروس جديدة' : 'تم اضافة درس جديد';

        $this->successMsg($sucess_msg);

        $this->reloadPage();
    }

    public function updateLessonTitle(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $lesson_title = $request->input('lesson_title');

        OnlineCourseLesson::where('id', $lesson_id)->update([
            'title' => $lesson_title,
        ]);
    }

    public function updateVideo(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $video_type = $request->input('video_type');

        if($video_type == 'vimeo')
        {
            $video_url = $this->parseVimeoURL($request->input('video_url'));
        }

        if($video_type == 'youtube')
        {
            $video_url = $this->parseYouTubeURL($request->input('video_url'));
        }

        if($video_type == 'drive')
        {
            $video_url = $request->input('video_url');
        }

        OnlineCourseLesson::where('id', $lesson_id)->update([
            'video_type' => $video_type,
            'video_url' => $video_url,
        ]);
        
        echo '<b class="text-success">New Video has been updated</b>';

        $this->reloadPage();
    }

    public function deleteLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        if(OnlineCourseLesson::where('id', $lesson_id)->delete())
        {
            $this->successMsg('تم مسح الدرس');
            $this->reloadPage();
        }
    }

    public function lockOrUnlockLesson(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $isLocked = $request->input('data')['isLocked'];
        
        OnlineCourseLesson::where('id', $lesson_id)->update([
            'isLocked' => $isLocked == 'true' ? 1 : 0, 
        ]);

        $this->successMsg($isLocked == 'true' ? 'تم وضع الدرس علي خاصية الخاص' : 'تم وضع الدرس علي خاصية العام');
    }

    public function previewLesson(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];

        $onlineCourseLesson = OnlineCourseLesson::where('id', $lesson_id)->first();

        return view('coach.pages.my-course.update-lesson')->with('onlineCourseLesson', $onlineCourseLesson);
    }

    public function previewCurrentIntroMedia(Request $request)
    {
        $my_course_id = $request->input('data')['my_course_id'];

        $myCourse = OnlineCourse::where('id', $my_course_id)->first();

        switch($myCourse->media_intro)
        {
            case 'image':
                echo '
                <img src="'.asset('images/online-courses/'.$myCourse->id.'/'.$myCourse->image).'" class="img-fluid">
                ';
            break;
                
            case 'video':
                echo '
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/'.$myCourse->video_url.'?rel=0" allowfullscreen></iframe>
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
                return view('coach.pages.my-course.media-intro-type.image');
            break;
                
            case 'video':
                return view('coach.pages.my-course.media-intro-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }
}

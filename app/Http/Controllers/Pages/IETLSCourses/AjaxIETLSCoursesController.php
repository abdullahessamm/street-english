<?php

namespace App\Http\Controllers\Pages\IETLSCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\IETLSCourses\IETLSCourse;
use App\Models\IETLSCourses\IETLSCourseContent;
use App\Models\IETLSCourses\IETLSCourseLesson;
use App\Models\IETLSCourses\IETLSCourseInstructor;
use App\Models\IETLSCourses\IETLSCourseLessonAudio;
use App\Models\IETLSCourses\IETLSCourseLessonContext;
use App\Models\IETLSCourses\IETLSCourseLessonDoc;
use App\Models\IETLSCourses\IETLSCourseLessonExercise;
use App\Models\IETLSCourses\IETLSCourseLessonFrame;
use App\Models\IETLSCourses\IETLSCourseLessonInfo;
use App\Models\IETLSCourses\IETLSCourseLessonInstructor;
use App\Models\IETLSCourses\IETLSCourseLessonVideo;

class AjaxIETLSCoursesController extends Controller
{
    public function index()
    {
        $course = IETLSCourse::query();

        return Datatables::of($course)
        ->editColumn('name', function ($course) {
            return '<a href="'.route('ietls-course.show', [$course->slug]).'">'.$course->name.'</a>';
        })
        ->editColumn('created_at', function ($course) {
            return date("Y-m-d h:i:s a", strtotime($course->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    // create course
    public function create(Request $request)
    {
        $Ietls_course_name = $request->input('ietls_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $Ietls_course_category_id = $request->input('ietls_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $thumbnail = $request->file('thumbnail');
        $choose_media = $request->input('choose_media');
        $image = null;
        $video_url = $request->input('video');
        $instructors = $request->input('coaches') != null ? $request->input('coaches') : null;
        $slug = $this->slugify($Ietls_course_name);

        // check if at least one instructor choosen
        if($instructors == null)
        {
            $this->errorMsg("You must choose at least one instructor");
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
            'Ietls_course_category_id' => $Ietls_course_category_id,
            'name' => $Ietls_course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language, 
            'price' => $price, 
            'discount' => $discount, 
            'media_intro' => $choose_media, 
            'video_url' => $video_url, 
            'image' => $image, 
            'thumbnail' => 'thumbnail.'.$thumbnail->getClientOriginalExtension(), 
            'description' => $description,
            'slug' => $slug,
            'isPublished' => 1,
        ];

        // upload course data
        $course = IETLSCourse::firstOrCreate(['name' => $Ietls_course_name], $data);

        foreach($instructors as $instructor)
        {
            $IETLSCourseInstructor = new IETLSCourseInstructor();
            $IETLSCourseInstructor->coach_id = $instructor;
            $IETLSCourseInstructor->Ietls_course_id = $course->id;
            $IETLSCourseInstructor->approved = true;
            $IETLSCourseInstructor->save();
        }

        $Ietls_course_path = $this->getUniversalPath('public/images/ielts-courses/'.$course->id);

        $this->uploadFile($request, 'thumbnail', $Ietls_course_path, 'thumbnail');
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $Ietls_course_path, 'image') : null;

        $this->successMsg("تمت اضافة دورة جديدة");

        $this->redierctTo('ietls-course/show/'.$slug);
    }

    // update course
    public function update(Request $request)
    {
        $Ietls_course_id = $request->input('Ietls_course_id');

        $course = IETLSCourse::where('id', $Ietls_course_id)->first();

        $Ietls_course_name = $request->input('ietls_course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $Ietls_course_category_id = $request->input('Ietls_course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $choose_media = $request->input('choose_media') == 'none' ? $course->media_intro : $request->input('choose_media');
        $video_url = $request->input('video');
        $slug = $this->slugify($Ietls_course_name);

        // check if thumbnail extension is allowed
        if($request->hasFile('thumbnail'))
        {
            // get old thumbnail
            $old_thumbnail = $this->getUniversalPath('public/images/ielts-courses/'.$course->id.'/'.$course->thumbnail);
            
            // delete old thumbnail
            $this->removeFile($old_thumbnail);

            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('thumbnail')->getClientOriginalExtension(), "Thumbnail image extension is not allowed");
            
            $thumbnail_name = md5(uniqid());

            $thumbnail = $thumbnail_name.'.'.$request->file('thumbnail')->getClientOriginalExtension();
        }
        else
        {
            $thumbnail = $course->thumbnail;
        }

        // check if intro image is uploaded
        if($request->hasFile('image'))
        {
            $this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension(), "Intro image extension is not allowed");

            $image_name = md5(uniqid());

            $image = $image_name.'.'.$request->file('image')->getClientOriginalExtension();
        }
        else
        {
            $image = $course->image;
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
            $video_url = $course->video_url;
        }

        $Ietls_course_path = $this->getUniversalPath('public/images/ielts-courses/'.$course->id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $Ietls_course_path, $thumbnail_name) : false;
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $Ietls_course_path, 'banner') : false;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $Ietls_course_path, $image_name) : false;
        
        IETLSCourse::where('id', $Ietls_course_id)->update([
            'name' => $Ietls_course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language,
            'Ietls_course_category_id' => $Ietls_course_category_id, 
            'price' => $price, 
            'discount' => $discount, 
            'media_intro' => $choose_media, 
            'video_url' => $video_url, 
            'image' => $image, 
            'thumbnail' => $thumbnail,
            'description' => $description,
            'slug' => $slug,
        ]);

        $this->successMsg("تم تحديث دورة : ".$course->name);

        $this->redierctTo('ietls-course/show/'.$slug);
    }

    // publish course
    public function publish(Request $request)
    {
        $Ietls_course_id = $request->input('Ietls_course_id');
        
        IETLSCourse::where('id', $Ietls_course_id)->update([
            'isPublished' => 1,
        ]);

        $this->successMsg("تم نشر هذة الدورة");

        $this->reloadPage();
    }

    // un-publish course
    public function unPublish(Request $request)
    {
        $Ietls_course_id =$request->input('Ietls_course_id');

        IETLSCourse::where('id', $Ietls_course_id)->update([
            'isPublished' => 0,
        ]);

        $this->successMsg("تم اخفاء هذة الدورة");

        $this->reloadPage();
    }

    // delete course
    public function delete(Request $request)
    {
        $Ietls_course_id = $request->input('Ietls_course_id');
        
        $Ietls_course_images_path = $this->getUniversalPath('public/images/ielts-courses/'.$Ietls_course_id);
        $Ietls_course_contents_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$Ietls_course_id);

        if(IETLSCourse::where('id', $Ietls_course_id)->delete())
        {
            file_exists($Ietls_course_images_path) ? $this->deleteDir($Ietls_course_images_path) : true;
            file_exists($Ietls_course_contents_path) ? $this->deleteDir($Ietls_course_contents_path) : true;
        }

        $this->successMsg("تمت ازاله هذة الدورة من قاعدة البيانات");
        $this->redierctTo('courses');
    }

    // create content for the course
    public function createContent(Request $request)
    {
        $Ietls_course_id = $request->input('ietls_course_id');
        $content_name = $request->input('content_name');
        $description = $request->input('description');
        $slug = $this->slugify($content_name);

        IETLSCourseContent::create([
            'Ietls_course_id' => $Ietls_course_id,
            'title' => $content_name,
            'description' => $description,
            'slug' => $slug,
        ]);
        
        $this->successMsg("New content has been added to this course");

        $this->reloadPage();
    }

    // update content title
    public function updateContentTitle(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_title = $request->input('content_title');

        IETLSCourseContent::where('id', $content_id)->update([
            'title' => $content_title,
        ]);
    }
    
    // update content description
    public function updateContentDescription(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_description = $request->input('content_description');

        IETLSCourseContent::where('id', $content_id)->update([
            'description' => $content_description,
        ]);
    }

    // delete content 
    public function deleteContent(Request $request)
    {
        $content_id = $request->input('content_id');

        $courseContent = IETLSCourseContent::where('id', $content_id)->first();

        $Ietls_course_id = $courseContent->belongsToCourse->id;

        $content_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$Ietls_course_id.'/contents/'.$content_id);

        if($courseContent->delete())
        {
            file_exists($content_path) ? $this->deleteDir($content_path) : false;

            $this->successMsg("تم مسح الدورة بجميع محتوياتها");

            $this->reloadPage();
        }
    }

    // create new lesson
    public function createLesson(Request $request)
    {
        $content_id = $request->input('content_id');

        $lessons = $request->input('lessons');
        
        for($i = 0; $i < count($lessons); $i++)
        {
            $lesson_title = $lessons[$i]['lesson_title'];
            
            $slug = md5(uniqid());

            IETLSCourseLesson::create([
                'Ietls_course_content_id' => $content_id,
                'title' => $lesson_title,
                'slug' => $slug,
            ]);
        }

        $sucess_msg = count($lessons) > 1 ? 'تمت اضافة دروس جديدة' : 'تمت اضافة درس جديد';

        $this->successMsg($sucess_msg);

        $this->reloadPage();
    }

    // create lesson type
    public function createLessonType(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $lesson_type = $request->input('lesson_type');

        IETLSCourseLesson::where('id', $lesson_id)->update([
            'type' => $lesson_type,
        ]);

        IETLSCourseLessonInfo::firstOrCreate(['Ietls_course_lesson_id' => $lesson_id], ['Ietls_course_lesson_id' => $lesson_id]);

        $this->successMsg("تم تغيير نوع الدرس");

        $this->reloadPage();
    }

    // delete lesson
    public function deleteLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $courseLesson = IETLSCourseLesson::where('id', $lesson_id)->first();
        $Ietls_course_slug = $courseLesson->belongsToContent->belongsToCourse->slug;
        $Ietls_course_id = $courseLesson->belongsToContent->belongsToCourse->id;
        $Ietls_course_content_id = $courseLesson->belongsToContent->id;

        $Ietls_course_lesson_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$Ietls_course_id.'/contents/'.$Ietls_course_content_id.'/lessons/'.$lesson_id);

        if($courseLesson->delete())
        {
            file_exists($Ietls_course_lesson_path) ? $this->deleteDir($Ietls_course_lesson_path) : false;

            $this->successMsg("تم مسح هذا الدرس بجميع محتوياتة");

            $this->redierctTo('ietls-course/show/'.$Ietls_course_slug.'/contents');
        }
    }

    // lock this lesson
    public function isLocked(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $isLocked = $request->input('data')['isLocked'];
        
        if($isLocked == "true")
        {
            IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
                'isLocked' => 1,
            ]);

            $this->successMsg("تم اخفاء هذا الدرس للمستخدمين الغير المشتركين في الدورة");
        }
        else
        {
            IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
                'isLocked' => 0,
            ]);

            $this->successMsg("تم وضع الدرس علي خلفية عام");
        }
    }

    // check if this lesson is continuable or not
    public function isContinueable(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $isContinueable = $request->input('data')['isContinueable'];
        
        if($isContinueable == "true")
        {
            IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
                'isContinueable' => 1,
            ]);

            $this->successMsg("يمكنك استكمال الدروس بعد هذا الدرس");
        }
        else
        {
            IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
                'isContinueable' => 0,
            ]);

            $this->successMsg("لا يمكنك استكمال الدروس الا بعد الانتهاء من هذا الدرس");
        }
    }

    // check if this lesson is achievable or not
    public function isAchievable(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $isAchievable = $request->input('data')['isAchievable'];

        $getPoints = IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->first()->points;

        if($isAchievable == "true")
        {
            IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
                'isAchievable' => 1,
            ]);

            return view('pages.ietls-courses.points')
            ->with('lesson_id', $lesson_id)
            ->with('getPoints', $getPoints);
        }

        IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
            'isAchievable' => 0,
            'points' => 0,
        ]);

        $this->successMsg("تم ازاله كل النقاط من الدرس");
    }

    // add points to this lesson if achievable
    public function addPoints(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $points = $request->input('data')['points'];

        IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $lesson_id)->update([
            'points' => $points,
        ]);

        $this->successMsg("تم اضافة : ".$points." نقطة عند اكمال هذا الدرس ");

        $this->reloadPage();
    }

    // update lesson description
    public function updateLessonDescription(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $lesson_description = $request->input('data')['lesson_description'];
        
        IETLSCourseLesson::where('id', $lesson_id)->update([
            'description' => $lesson_description,
        ]);

        $this->successMsg("تم تحديث شرح الدرس");
    }

    // choose an instructor for a lesson
    public function chooseInstructor(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $instructor_id = $request->input('data')['instructor_id'];

        IETLSCourseLessonInstructor::updateOrCreate(['Ietls_course_lesson_id' => $lesson_id],[
            'Ietls_course_lesson_id' => $lesson_id, 
            'coach_id' => $instructor_id
        ]);

        $this->successMsg("تم اختيار محاضر لهذا الدرس");

        $this->reloadPage();
    }

    // check if this lesson is published or not
    public function isLessonPublished(Request $request)
    {
        $lesson_info_id = $request->input('data')['lesson_info_id'];
        $isPublished = $request->input('data')['isPublished'] == 1 ? 1 : 0;
        $lessonInfo = IETLSCourseLessonInfo::where('id', $lesson_info_id)->first();

        $Ietls_course_lesson_id = $lessonInfo->belongsToCourseLesson->id;

        switch ($lessonInfo->belongsToCourseLesson->type) 
        {
            case 'video':
                $lessonInfo->belongsToCourseLesson->video == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم توفر فيديو للدرس") : true;
            break;

            case 'audio':
                $lessonInfo->belongsToCourseLesson->audio == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم توفر مقطع صوتي للدرس") : true;
            break;

            case 'doc':
                $lessonInfo->belongsToCourseLesson->doc == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم توفر ملف pdf للدرس") : true;
            break;

            case 'context':
                $lessonInfo->belongsToCourseLesson->context == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم توفر محتوي كتابي") : true;
            break;

            case 'frame':
                $lessonInfo->belongsToCourseLesson->frame == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم وجود رابط توجيهي داخل الدرس") : true;
            break;

            case 'exercise':
                $lessonInfo->belongsToCourseLesson->exercise == null ? $this->errorMsg("لا يمكنك نشر هذا الدرس بسبب عدم وجود رابط توجيهي داخل الدرس") : true;
            break;
        }

        IETLSCourseLessonInstructor::where('Ietls_course_lesson_id', $Ietls_course_lesson_id)->count() != 1 ? $this->errorMsg("يجب اختيار محاضر واحد لنشر هذا الدرس") : true;

        IETLSCourseLessonInfo::where('Ietls_course_lesson_id', $Ietls_course_lesson_id)->update([
            'isPublished' => $isPublished,
        ]);

        $isPublished == 1 ? $this->successMsg("تم نشر هذا الدرس") : $this->successMsg("تم اخفاء هذا الدرس من جميع المستخدمين");
    }

    // upload lesson video
    public function uploadVideoLesson(Request $request)
    {
        $Ietls_course_lesson_id = $request->input('lesson_id');
        $video_type = $request->input('video_type');

        switch ($video_type)
        { 
            case 'youtube':
                $video_url = $this->parseYouTubeURL($request->input('video_url'));
            break;

            case 'vimeo':
                $video_url = $this->parseVimeoURL($request->input('video_url'));
            break;

            case 'drive':
                $video_url = $request->input('video_url');
            break;
        }

        IETLSCourseLessonVideo::firstOrCreate(['Ietls_course_lesson_id' => $Ietls_course_lesson_id],[
            'Ietls_course_lesson_id' => $Ietls_course_lesson_id,
            'type' => $video_type,
            'url' => $video_url,
        ]);

        $this->successMsg("New Video has been added to this lesson");

        $this->reloadPage();
    }

    // update lesson video
    public function updateVideoLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = IETLSCourseLesson::where('id', $lesson_id)->first();

        $lesson_video_id = $request->input('lesson_video_id');
        $video_type = $request->input('video_type');

        switch ($video_type)
        { 
            case 'youtube':
                $video_url = $this->parseYouTubeURL($request->input('video_url'));
            break;

            case 'vimeo':
                $video_url = $this->parseVimeoURL($request->input('video_url'));
            break;

            case 'drive':
                $video_url = $request->input('video_url');
            break;
        }

        // update video lesson data
        IETLSCourseLessonVideo::where('id', $lesson_video_id)->update([
            'Ietls_course_lesson_id' => $lesson_id,
            'type' => $video_type,
            'url' => $video_url,
        ]);

        $this->successMsg("تم تغيير تحديث الفيديو");

        $this->reloadPage();
    }

    // check if the lesson video is downloadable or not
    public function isVideoLessonDownloadable(Request $request)
    {
        $lesson_video_id = $request->input('data')['lesson_video_id'];
        $isVideoDownloadable = $request->input('data')['isVideoDownloadable'] == 1 ? 1 : 0;

        IETLSCourseLessonInstructor::where('id', $lesson_video_id)->update([
            'isDownloadable' => $isVideoDownloadable
        ]);

        $request->input('data')['isVideoDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل الفيديو") : $this->successMsg("تم الغاء خاصية تحميل الفيديو");

        $this->reloadPage();
    }

    // upload lesson audio
    public function uploadAudioLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = IETLSCourseLesson::where('id', $lesson_id)->first();

        $duration = $request->input('duration');
        $type = $request->input('type');
        $size = $request->input('size');
        $audio = $request->file('audio_lesson');

        $audio_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['mp3'], $audio->getClientOriginalExtension(), 'Audio extension is not allowed');

        $this->uploadFile($request, 'audio_lesson', $lesson_path, $audio_file_name);

        IETLSCourseLessonAudio::firstOrCreate(['Ietls_course_lesson_id' => $lesson_id],[
            'lesson_id' => $lesson_id,
            'audio' => $audio_file_name.'.'.$audio->getClientOriginalExtension(),
            'duration' => $duration,
            'type' => $type,
            'size' => $size,
        ]);

        $this->successMsg("New Audio has been added to this lesson");

        $this->reloadPage();
    }

    // update lesson audio
    public function updateAudioLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = IETLSCourseLesson::where('id', $lesson_id)->first();

        $lesson_audio_id = $request->input('lesson_audio_id');
        $duration = $request->input('duration');
        $type = $request->input('type');
        $size = $request->input('size');
        $audio = $request->file('audio_lesson');

        $audio_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['mp3'], $audio->getClientOriginalExtension(), 'Audio extension is not allowed');

        // remove old file
        $this->removeFile($lesson_path, $lesson->audio->audio);

        // upload the new lesson
        $this->uploadFile($request, 'audio_lesson', $lesson_path, $audio_file_name);

        // update audio lesson data
        IETLSCourseLessonAudio::where('id', $lesson_audio_id)->update([
            'Ietls_course_lesson_id' => $lesson_id,
            'audio' => $audio_file_name.'.'.$audio->getClientOriginalExtension(),
            'duration' => $duration,
            'type' => $type,
            'size' => $size,
            'isDownloadable' => 0,
        ]);

        $this->successMsg("تم تغيير تحديث الفيديو");

        $this->reloadPage();
    }
    
    // check if the lesson audio is downloadable or not
    public function isAudioLessonDownloadable(Request $request)
    {
        $lesson_audio_id = $request->input('data')['lesson_audio_id'];
        $isAudioDownloadable = $request->input('data')['isAudioDownloadable'] == 1 ? 1 : 0;

        IETLSCourseLessonAudio::where('id', $lesson_audio_id)->update([
            'isDownloadable' => $isAudioDownloadable
        ]);

        $request->input('data')['isAudioDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل المقطع الصوتي") : $this->successMsg("تم الغاء خاصية تحميل المقطع الصوتي");

        $this->reloadPage();
    }

    // upload lesson pdf doc
    public function uploadDocLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = IETLSCourseLesson::where('id', $lesson_id)->first();

        $doc = $request->file('doc');
        $pages = $request->input('pages');

        $doc_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['pdf'], $doc->getClientOriginalExtension(), 'Doc extension is not allowed');

        $this->uploadFile($request, 'doc', $lesson_path, $doc_file_name);

        IETLSCourseLessonDoc::firstOrCreate(['Ietls_course_lesson_id' => $lesson_id],[
            'lesson_id' => $lesson_id,
            'pdf' => $doc_file_name.'.'.$doc->getClientOriginalExtension(),
            'pages' => $pages,
        ]);

        $this->successMsg("New PDF has been added to this lesson");

        $this->reloadPage();
    }

    // update lesson pdf doc
    public function updateDocLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $lesson_doc_id = $request->input('lesson_doc_id');

        $courseLessonDoc = IETLSCourseLessonDoc::where('id', $lesson_doc_id)->first();

        $lesson = IETLSCourseLesson::where('id', $lesson_id)->first();

        $doc = $request->file('doc');

        $doc_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/uploads/ielts-courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['pdf'], $doc->getClientOriginalExtension(), 'Doc extension is not allowed');

        // remove old file
        $this->removeFile($lesson_path, $courseLessonDoc->pdf);

        // upload new file
        $this->uploadFile($request, 'doc', $lesson_path, $doc_file_name);

        // update file data
        IETLSCourseLessonDoc::where('id', $lesson_doc_id)->update([
            'pdf' => $doc_file_name.'.'.$doc->getClientOriginalExtension(),
            'isDownloadable' => 0,
        ]);

        $this->successMsg("تم تحديث ملف ال pdf");

        $this->reloadPage();
    }

    // update lesson doc pages
    public function updateDocPagesLesson(Request $request)
    {
        $lesson_doc_id = $request->input('data')['lesson_doc_id'];
        $pages = $request->input('data')['pages'];

        IETLSCourseLessonDoc::where('id', $lesson_doc_id)->update([
            'pages' => $pages,
        ]);

        $this->successMsg("تم تحديث عدد الصفحات الي ".$pages." صفحة");
    }

    // check if the lesson doc is downloadable or not
    public function isDocLessonDownloadable(Request $request)
    {
        $lesson_doc_id = $request->input('data')['lesson_doc_id'];
        $isDocDownloadable = $request->input('data')['isDocDownloadable'] == 1 ? 1 : 0;

        IETLSCourseLessonDoc::where('id', $lesson_doc_id)->update([
            'isDownloadable' => $isDocDownloadable
        ]);

        $request->input('data')['isDocDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل ملف ال pdf") : $this->successMsg("تم الغاء خاصية تحميل ملف ال pdf");

        $this->reloadPage();
    }

    // create lesson context
    public function createLessonContext(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $content = $request->input('lesson_description');

        IETLSCourseLessonContext::firstOrCreate(['Ietls_course_lesson_id' => $lesson_id],[
            'Ietls_course_lesson_id' => $lesson_id,
            'content' => $content,
        ]);

        $this->successMsg("تم اضافة محتوي كتابي لهذا الدرس");

        $this->reloadPage();
    }

    // update lesson context
    public function updateLessonContext(Request $request)
    {
        $lesson_context_id = $request->input('lesson_context_id');
        $content = $request->input('lesson_description');

        IETLSCourseLessonContext::where('id', $lesson_context_id)->update([
            'content' => $content,
        ]);

        $this->successMsg("تم تحديث المحتوي كتابي الخاص بهذا الدرس");

        $this->reloadPage();
    }

    // create lesson context
    public function createLessonFrame(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $url = $request->input('url');

        IETLSCourseLessonFrame::firstOrCreate(['Ietls_course_lesson_id' => $lesson_id],[
            'Ietls_course_lesson_id' => $lesson_id,
            'url' => $url,
        ]);

        $this->successMsg("تم اضافة رابط داخل الاطار لهذا الدرس");

        $this->reloadPage();
    }
    
    // update lesson context
    public function updateLessonFrame(Request $request)
    {
        $lesson_frame_id = $request->input('lesson_frame_id');
        $url = $request->input('url');

        IETLSCourseLessonFrame::where('id', $lesson_frame_id)->update([
            'url' => $url,
        ]);

        $this->successMsg("تم تحديث الرابط بداخل الاطار");

        $this->reloadPage();
    }

    // create lesson exercise
    public function createLessonExercise(Request $request)
    {
        $Ietls_course_lesson_id = $request->input('lesson_id');
        $exam_id = $request->input('exam_id');

        IETLSCourseLessonExercise::create([
            'Ietls_course_lesson_id' => $Ietls_course_lesson_id,
            'exam_id' => $exam_id,
        ]);

        $this->successMsg('تم انشاء اسئلة تدريبية للدرس');

        $this->reloadPage();
    }

    // update lesson exercise
    public function updateLessonExercise(Request $request)
    {
        $lesson_exercise_id = $request->input('lesson_exercise_id');
        $exam_id = $request->input('exam_id');
        
        IETLSCourseLessonExercise::where('id', $lesson_exercise_id)->update([
            'exam_id' => $exam_id,
        ]);

        $this->successMsg('تم تحديث الاسئلة تدريبية للدرس');

        $this->reloadPage();
    }

    public function previewMediaType(Request $request)
    {
        $type = $request->input('type');

        switch($type)
        {
            case 'image':
                return view('pages.ietls-courses.media-intro-type.image');
            break;
                
            case 'video':
                return view('pages.ietls-courses.media-intro-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }
}
<?php

namespace App\Http\Controllers\Pages\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Yajra\DataTables\DataTables;
use App\Models\Courses\Course;
use App\Models\Courses\CourseContent;
use App\Models\Courses\CourseLesson;
use App\Models\Courses\CourseInstructor;
use App\Models\Courses\CourseLessonAudio;
use App\Models\Courses\CourseLessonContext;
use App\Models\Courses\CourseLessonDoc;
use App\Models\Courses\CourseLessonExercise;
use App\Models\Courses\CourseLessonFrame;
use App\Models\Courses\CourseLessonInfo;
use App\Models\Courses\CourseLessonInstructor;
use App\Models\Courses\CourseLessonVideo;

class AjaxCourseController extends Controller
{
    public function index()
    {
        $course = Course::query();

        return Datatables::of($course)
        ->editColumn('name', function ($course) {
            return '<a href="'.route('course.show', [$course->slug]).'">'.$course->name.'</a>';
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
        $course_name = $request->input('course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $course_category_id = $request->input('course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $thumbnail = $request->file('thumbnail');
        $choose_media = $request->input('choose_media');
        $image = null;
        $video_url = $request->input('video');
        $instructors = $request->input('coaches');
        $slug = $this->slugify($course_name);

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
            'course_category_id' => $course_category_id,
            'name' => $course_name, 
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
        $course = Course::firstOrCreate(['name' => $course_name], $data);

        foreach($instructors as $instructor)
        {
            $courseInstructor = new CourseInstructor();
            $courseInstructor->coach_id = $instructor;
            $courseInstructor->course_id = $course->id;
            $courseInstructor->approved = true;
            $courseInstructor->save();
        }

        $course_path = $this->getUniversalPath('public/public/images/courses/'.$course->id);

        $this->uploadFile($request, 'thumbnail', $course_path, 'thumbnail');
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $course_path, 'image') : null;

        $this->successMsg("تمت اضافة دورة جديدة");

        $this->redierctTo('course/show/'.$slug);
    }

    // update course
    public function update(Request $request)
    {
        $course_id = $request->input('course_id');

        $course = Course::where('id', $course_id)->first();

        $course_name = $request->input('course_name');
        $duration = $request->input('duration');
        $level = $request->input('level');
        $language = $request->input('language');
        $course_category_id = $request->input('course_category_id');
        $price = $request->input('price');
        $discount = $request->input('discount');
        $description = $request->input('description');
        $choose_media = $request->input('choose_media') == 'none' ? $course->media_intro : $request->input('choose_media');
        $video_url = $request->input('video');
        $slug = $this->slugify($course_name);

        // check if thumbnail extension is allowed
        if($request->hasFile('thumbnail'))
        {
            // get old thumbnail
            $old_thumbnail = $this->getUniversalPath('public/public/images/courses/'.$course->id.'/'.$course->thumbnail);
            
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

        $course_path = $this->getUniversalPath('public/public/images/courses/'.$course->id);

        $request->hasFile('thumbnail') ? $this->uploadFile($request, 'thumbnail', $course_path, $thumbnail_name) : false;
        $request->hasFile('banner') ? $this->uploadFile($request, 'banner', $course_path, 'banner') : false;
        $request->hasFile('image') ? $this->uploadFile($request, 'image', $course_path, $image_name) : false;
        
        Course::where('id', $course_id)->update([
            'name' => $course_name, 
            'duration' => $duration, 
            'level' => $level, 
            'language' => $language,
            'course_category_id' => $course_category_id, 
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

        $this->redierctTo('course/show/'.$slug);
    }

    // publish course
    public function publish(Request $request)
    {
        $course_id =$request->input('course_id');

        Course::where('id', $course_id)->update([
            'isPublished' => 1,
        ]);

        $this->successMsg("تم نشر هذة الدورة");

        $this->reloadPage();
    }

    // un-publish course
    public function unPublish(Request $request)
    {
        $course_id =$request->input('course_id');

        Course::where('id', $course_id)->update([
            'isPublished' => 0,
        ]);

        $this->successMsg("تم اخفاء هذة الدورة");

        $this->reloadPage();
    }

    // delete course
    public function delete(Request $request)
    {
        $course_id = $request->input('course_id');
        
        $course_images_path = $this->getUniversalPath('public/public/images/courses/'.$course_id);
        $course_contents_path = $this->getUniversalPath('public/public/uploads/courses/'.$course_id);

        if(Course::where('id', $course_id)->delete())
        {
            file_exists($course_images_path) ? $this->deleteDir($course_images_path) : true;
            file_exists($course_contents_path) ? $this->deleteDir($course_contents_path) : true;
        }

        $this->successMsg("تمت ازاله هذة الدورة من قاعدة البيانات");
        $this->redierctTo('courses');
    }

    // create content for the course
    public function createContent(Request $request)
    {
        $course_id = $request->input('course_id');
        $content_name = $request->input('content_name');
        $description = $request->input('description');
        $slug = $this->slugify($content_name);

        CourseContent::create([
            'course_id' => $course_id,
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

        CourseContent::where('id', $content_id)->update([
            'title' => $content_title,
        ]);
    }
    
    // update content description
    public function updateContentDescription(Request $request)
    {
        $content_id = $request->input('content_id');
        $content_description = $request->input('content_description');

        CourseContent::where('id', $content_id)->update([
            'description' => $content_description,
        ]);
    }

    // delete content 
    public function deleteContent(Request $request)
    {
        $content_id = $request->input('content_id');

        $courseContent = CourseContent::where('id', $content_id)->first();

        $course_id = $courseContent->belongsToCourse->id;

        $content_path = $this->getUniversalPath('public/public/uploads/courses/'.$course_id.'/contents/'.$content_id);

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

            CourseLesson::create([
                'course_content_id' => $content_id,
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

        CourseLesson::where('id', $lesson_id)->update([
            'type' => $lesson_type,
        ]);

        CourseLessonInfo::firstOrCreate(['course_lesson_id' => $lesson_id], ['course_lesson_id' => $lesson_id]);

        $this->successMsg("تم تغيير نوع الدرس");

        $this->reloadPage();
    }

    // delete lesson
    public function deleteLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $courseLesson = CourseLesson::where('id', $lesson_id)->first();
        $course_slug = $courseLesson->belongsToContent->belongsToCourse->slug;
        $course_id = $courseLesson->belongsToContent->belongsToCourse->id;
        $course_content_id = $courseLesson->belongsToContent->id;

        $course_lesson_path = $this->getUniversalPath('public/public/uploads/courses/'.$course_id.'/contents/'.$course_content_id.'/lessons/'.$lesson_id);

        if($courseLesson->delete())
        {
            file_exists($course_lesson_path) ? $this->deleteDir($course_lesson_path) : false;

            $this->successMsg("تم مسح هذا الدرس بجميع محتوياتة");

            $this->redierctTo('course/show/'.$course_slug.'/contents');
        }
    }

    // lock this lesson
    public function isLocked(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $isLocked = $request->input('data')['isLocked'];
        
        if($isLocked == "true")
        {
            CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
                'isLocked' => 1,
            ]);

            $this->successMsg("تم اخفاء هذا الدرس للمستخدمين الغير المشتركين في الدورة");
        }
        else
        {
            CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
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
            CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
                'isContinueable' => 1,
            ]);

            $this->successMsg("يمكنك استكمال الدروس بعد هذا الدرس");
        }
        else
        {
            CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
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

        $getPoints = CourseLessonInfo::where('course_lesson_id', $lesson_id)->first()->points;

        if($isAchievable == "true")
        {
            CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
                'isAchievable' => 1,
            ]);

            return view('pages.courses.points')
            ->with('lesson_id', $lesson_id)
            ->with('getPoints', $getPoints);
        }

        CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
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

        CourseLessonInfo::where('course_lesson_id', $lesson_id)->update([
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
        
        CourseLesson::where('id', $lesson_id)->update([
            'description' => $lesson_description,
        ]);

        $this->successMsg("تم تحديث شرح الدرس");
    }

    // choose an instructor for a lesson
    public function chooseInstructor(Request $request)
    {
        $lesson_id = $request->input('data')['lesson_id'];
        $instructor_id = $request->input('data')['instructor_id'];

        CourseLessonInstructor::updateOrCreate(['course_lesson_id' => $lesson_id],[
            'course_lesson_id' => $lesson_id, 
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
        $lessonInfo = CourseLessonInfo::where('id', $lesson_info_id)->first();

        $course_lesson_id = $lessonInfo->belongsToCourseLesson->id;

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

        CourseLessonInstructor::where('course_lesson_id', $course_lesson_id)->count() != 1 ? $this->errorMsg("يجب اختيار محاضر واحد لنشر هذا الدرس") : true;

        CourseLessonInfo::where('course_lesson_id', $course_lesson_id)->update([
            'isPublished' => $isPublished,
        ]);

        $isPublished == 1 ? $this->successMsg("تم نشر هذا الدرس") : $this->successMsg("تم اخفاء هذا الدرس من جميع المستخدمين");
    }

    // upload lesson video
    public function uploadVideoLesson(Request $request)
    {
        $course_lesson_id = $request->input('lesson_id');
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

        CourseLessonVideo::firstOrCreate(['course_lesson_id' => $course_lesson_id],[
            'course_lesson_id' => $course_lesson_id,
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

        $lesson = CourseLesson::where('id', $lesson_id)->first();

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
        CourseLessonVideo::where('id', $lesson_video_id)->update([
            'course_lesson_id' => $lesson_id,
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

        CourseLessonVideo::where('id', $lesson_video_id)->update([
            'isDownloadable' => $isVideoDownloadable
        ]);

        $request->input('data')['isVideoDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل الفيديو") : $this->successMsg("تم الغاء خاصية تحميل الفيديو");

        $this->reloadPage();
    }

    // upload lesson audio
    public function uploadAudioLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = CourseLesson::where('id', $lesson_id)->first();

        $duration = $request->input('duration');
        $type = $request->input('type');
        $size = $request->input('size');
        $audio = $request->file('audio_lesson');

        $audio_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['mp3'], $audio->getClientOriginalExtension(), 'Audio extension is not allowed');

        $this->uploadFile($request, 'audio_lesson', $lesson_path, $audio_file_name);

        CourseLessonAudio::firstOrCreate(['course_lesson_id' => $lesson_id],[
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

        $lesson = CourseLesson::where('id', $lesson_id)->first();

        $lesson_audio_id = $request->input('lesson_audio_id');
        $duration = $request->input('duration');
        $type = $request->input('type');
        $size = $request->input('size');
        $audio = $request->file('audio_lesson');

        $audio_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['mp3'], $audio->getClientOriginalExtension(), 'Audio extension is not allowed');

        // remove old file
        $this->removeFile($lesson_path, $lesson->audio->audio);

        // upload the new lesson
        $this->uploadFile($request, 'audio_lesson', $lesson_path, $audio_file_name);

        // update audio lesson data
        CourseLessonAudio::where('id', $lesson_audio_id)->update([
            'course_lesson_id' => $lesson_id,
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

        CourseLessonAudio::where('id', $lesson_audio_id)->update([
            'isDownloadable' => $isAudioDownloadable
        ]);

        $request->input('data')['isAudioDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل المقطع الصوتي") : $this->successMsg("تم الغاء خاصية تحميل المقطع الصوتي");

        $this->reloadPage();
    }

    // upload lesson pdf doc
    public function uploadDocLesson(Request $request)
    {
        $lesson_id = $request->input('lesson_id');

        $lesson = CourseLesson::where('id', $lesson_id)->first();

        $doc = $request->file('doc');
        $pages = $request->input('pages');

        $doc_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['pdf'], $doc->getClientOriginalExtension(), 'Doc extension is not allowed');

        $this->uploadFile($request, 'doc', $lesson_path, $doc_file_name);

        CourseLessonDoc::firstOrCreate(['course_lesson_id' => $lesson_id],[
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

        $courseLessonDoc = CourseLessonDoc::where('id', $lesson_doc_id)->first();

        $lesson = CourseLesson::where('id', $lesson_id)->first();

        $doc = $request->file('doc');

        $doc_file_name = md5(uniqid());

        $lesson_path = $this->getUniversalPath('public/uploads/courses/'.$lesson->belongsToContent->belongsToCourse->id.'/contents/'.$lesson->belongsToContent->id.'/lessons/'.$lesson_id);
        
        $this->isFileExtAllowed(['pdf'], $doc->getClientOriginalExtension(), 'Doc extension is not allowed');

        // remove old file
        $this->removeFile($lesson_path, $courseLessonDoc->pdf);

        // upload new file
        $this->uploadFile($request, 'doc', $lesson_path, $doc_file_name);

        // update file data
        CourseLessonDoc::where('id', $lesson_doc_id)->update([
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

        CourseLessonDoc::where('id', $lesson_doc_id)->update([
            'pages' => $pages,
        ]);

        $this->successMsg("تم تحديث عدد الصفحات الي ".$pages." صفحة");
    }

    // check if the lesson doc is downloadable or not
    public function isDocLessonDownloadable(Request $request)
    {
        $lesson_doc_id = $request->input('data')['lesson_doc_id'];
        $isDocDownloadable = $request->input('data')['isDocDownloadable'] == 1 ? 1 : 0;

        CourseLessonDoc::where('id', $lesson_doc_id)->update([
            'isDownloadable' => $isDocDownloadable
        ]);

        $request->input('data')['isDocDownloadable'] == 1 ? $this->successMsg("تم السماح بتنزيل ملف ال pdf") : $this->successMsg("تم الغاء خاصية تحميل ملف ال pdf");

        $this->reloadPage();
    }

    // create lesson context
    public function createLessonFrame(Request $request)
    {
        $lesson_id = $request->input('lesson_id');
        $url = $request->input('url');

        CourseLessonFrame::firstOrCreate(['course_lesson_id' => $lesson_id],[
            'course_lesson_id' => $lesson_id,
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

        CourseLessonFrame::where('id', $lesson_frame_id)->update([
            'url' => $url,
        ]);

        $this->successMsg("تم تحديث الرابط بداخل الاطار");

        $this->reloadPage();
    }

    // create lesson exercise
    public function createLessonExercise(Request $request)
    {
        $course_lesson_id = $request->input('lesson_id');
        $exam_id = $request->input('exam_id');

        CourseLessonExercise::create([
            'course_lesson_id' => $course_lesson_id,
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
        
        CourseLessonExercise::where('id', $lesson_exercise_id)->update([
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
                return view('pages.courses.media-intro-type.image');
            break;
                
            case 'video':
                return view('pages.courses.media-intro-type.video');
            break;

            case 'none':
                return '';
            break;
        }
    }

    public function previewPriceOption(Request $request)
    {
        $price_option = $request->input('type');

        $course = Course::where('id', $request->input('course_id'))->first();
        
        switch($request->input('price_option')){

            case 'price':
                return view('pages.courses.price-options.price', compact('course'));
            break;

            case 'discount':
                return view('pages.courses.price-options.price-discount', compact('course'));
            break;

            case 'coupon':
                return view('pages.courses.price-options.coupon', compact('course'));
            break;
        }
    }
}
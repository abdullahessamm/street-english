<?php

namespace App\Http\Controllers\Pages\ZoomCourses;

use App\Http\Controllers\Controller;
use App\Models\EnrolledStudents\EnrolledStudentForZoomCourse;
use App\Models\Students\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevel;
use App\Models\ZoomCourses\ZoomCourseLevelUser;
use App\Models\ZoomCourses\ZoomCourseSession;
use App\Models\ZoomCourses\ZoomCourseSessionUser;
use Whoops\Run;

class AjaxZoomCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $zoomCourse = ZoomCourse::query();

        return Datatables::of($zoomCourse)
        ->editColumn('title', function ($zoomCourse) {
            return '<a href="'.route('zoom-course.show', [$zoomCourse->slug]).'">'.$zoomCourse->title.'</a>';
        })
        ->editColumn('levels', function ($zoomCourse) {
            return $zoomCourse->levels->count();
        })
        ->editColumn('created_at', function ($zoomCourse) {
            return date("Y-m-d h:i:s a", strtotime($zoomCourse->created_at));
        })
        ->rawColumns(['title'])
        ->make(true);
    }

    public function levels($slug)
    {
        $zoomCourse = ZoomCourse::where('slug', $slug)->first();

        $zoomCourseLevel = ZoomCourseLevel::where('zoom_course_id', $zoomCourse->id)->get();

        return Datatables::of($zoomCourseLevel)
        ->editColumn('title', function ($zoomCourseLevel) {
            return '<a href="'.route('zoom-course.level.show', [$zoomCourseLevel->belongsToZoomCourse->slug, $zoomCourseLevel->slug]).'">'.$zoomCourseLevel->title.'</a>';
        })
        ->editColumn('sessions', function ($zoomCourseLevel) {
            return $zoomCourseLevel->sessions->count();
        })
        ->editColumn('delete', function ($zoomCourseLevel) {
            return '<button type="button" class="btn btn-danger btn-sm font-weight-bold deleteZoomCourseLevel" data-zoom-course-level-id="'.$zoomCourseLevel->id.'">Delete this Level</button>';
        })
        ->editColumn('created_at', function ($zoomCourseLevel) {
            return date("Y-m-d h:i a", strtotime($zoomCourseLevel->created_at));
        })
        ->rawColumns(['title', 'delete'])
        ->make(true);
    }

    public function sessions($zoom_course_slug, $level_slug)
    {
        $zoomCourse = ZoomCourse::where('slug', $zoom_course_slug)->first();
        $zoomCourseLevel = ZoomCourseLevel::where('zoom_course_id', $zoomCourse->id)->where('slug', $level_slug)->first();

        $zoomCourseSession = $zoomCourseLevel->sessions;

        return Datatables::of($zoomCourseSession)
        ->editColumn('title', function ($zoomCourseSession) {
            return '<a href="'.route('zoom-course.level.session.show', [$zoomCourseSession->belongsToZoomCourseLevel->belongsToZoomCourse->slug, $zoomCourseSession->belongsToZoomCourseLevel->slug, $zoomCourseSession->slug]).'">'.$zoomCourseSession->title.'</a>';
        })
        ->editColumn('delete', function ($zoomCourseSession) {
            return '<button type="button" class="btn btn-danger btn-sm font-weight-bold deleteZoomCourseLevelSession" data-zoom-course-level-sesison-id="'.$zoomCourseSession->id.'">Delete this Sessions</button>';
        })
        ->editColumn('created_at', function ($zoomCourseSession) {
            return date("Y-m-d h:i a", strtotime($zoomCourseSession->created_at));
        })
        ->rawColumns(['title', 'delete'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $title = $request->input('course_zoom_title');
        $description = $request->input('course_zoom_description');
        $zoomCourseImage = $request->file('course_zoom_image');
        $slug = $this->slugify($title);
        $levels = $request->input('levels');
        $private_price = $request->input('private_price');
        $group_price = $request->input('group_price');
        $zoom_course_image_name = md5(uniqid());

        ZoomCourse::where('title', $title)->where('slug', $slug)->first() ? $this->errorMsg('This course is already exists') : true;
        
        $zoomCourse = ZoomCourse::create([
            'title' => $title,
            'description' => $description,
            'private_price' => $private_price,
            'group_price' => $group_price,
            'image' => $zoom_course_image_name.'.'.$zoomCourseImage->getClientOriginalExtension(),
            'slug' => $slug,
        ]);

        $zoom_course_path = $this->getUniversalPath('public/images/zoom-courses/'.$zoomCourse->id);

        $this->uploadFile($request, 'course_zoom_image', $zoom_course_path, $zoom_course_image_name);

        for($i = 0; $i < count($levels); $i++){

            ZoomCourseLevel::create([
                'zoom_course_id' => $zoomCourse->id,
                'title' => $levels[$i]['level_name'],
                'slug' => $this->slugify($levels[$i]['level_name'])
            ]);
        }

        $this->successMsg('New Zoom Course has been created');

        $this->redierctTo('zoom-course/show/'.$slug);
    }

    public function updateDetails(Request $request)
    {
        $zoom_course_id = $request->input('course_zoom_id');

        ZoomCourse::where('id', $zoom_course_id)->update([
            'title' => $request->input('course_zoom_title'),
            'description' => $request->input('course_zoom_description'),
            'private_price' => $request->input('private_price'),
            'group_price' => $request->input('group_price'),
        ]);

        $this->successMsg('Zoom Course Details has been updated');

        $this->reloadPage();
    }

    public function updateImage(Request $request)
    {
        $zoom_course_id = $request->input('course_zoom_id');
        
        $zoomCourse = ZoomCourse::where('id', $zoom_course_id)->first();
        $courseZoomImage = $request->file('course_zoom_image');

        if(!in_array($courseZoomImage->getClientOriginalExtension(), ['jpeg', 'png', 'jpg'])){
            $this->errorMsg('Image extension is not allowed');
        }

        // get old image path
        $old_image = $this->getUniversalPath('public/images/zoom-courses/'.$zoomCourse->id.'/'.$zoomCourse->image);

        // delete old image
        file_exists($old_image) ? $this->removeFile($old_image) : true;

        // rename image name
        $zoom_course_image_name = md5(uniqid());

        // get image path to upload
        $course_zoom_image_path = $this->getUniversalPath('public/images/zoom-courses/'.$zoomCourse->id);

        // upload new image
        $this->uploadFile($request, 'course_zoom_image', $course_zoom_image_path, $zoom_course_image_name);

        // update image in database
        $zoomCourse->update([
            'image' => $zoom_course_image_name.'.'.$courseZoomImage->getClientOriginalExtension()
        ]);

        $this->successMsg('Zoom Course image has been updated');

        $this->reloadPage();
    }

    public function removeImage(Request $request)
    {
        $zoom_course_id = $request->input('zoom_course_id');

        $zoomCourse = ZoomCourse::where('id', $zoom_course_id)->first();

        // get old image path
        $old_image = $this->getUniversalPath('public/images/zoom-courses/'.$zoomCourse->id.'/'.$zoomCourse->image);

        // delete old image
        file_exists($old_image) ? $this->removeFile($old_image) : true;

        // remove image from database
        $zoomCourse->update([
            'image' => null,
        ]);

        $this->successMsg('Image has been removed');

        $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $zoom_course_id = $request->input('zoom_course_id');

        $zoom_course_path = $this->getUniversalPath('public/images/zoom-courses/'.$zoom_course_id);

        file_exists($zoom_course_path) ? $this->deleteDir($zoom_course_path) : true;

        ZoomCourse::where('id', $zoom_course_id)->delete();

        $this->successMsg('This Zoom Course has been removed from our database');

        $this->redierctTo('zoom-courses');
    }

    public function deleteLevel(Request $request)
    {
        $zoom_course_level_id = $request->input('zoom_course_level_id');

        ZoomCourseLevel::where('id', $zoom_course_level_id)->delete();

        $this->successMsg('This level has been removed');

        $this->reloadPage();
    }

    public function appendNewLevel(Request $request)
    {
        $zoom_course_id = $request->input('course_zoom_id');

        $levels = $request->input('levels');

        for($i = 0; $i < count($levels); $i++){

            ZoomCourseLevel::where('zoom_course_id', $zoom_course_id)->firstOrCreate(['title' => $levels[$i]['level_name'], 'slug' => $this->slugify($levels[$i]['level_name'])], [
                'zoom_course_id' => $zoom_course_id,
                'title' => $levels[$i]['level_name'],
                'slug' => $this->slugify($levels[$i]['level_name'])
            ]);
        }

        $this->successMsg('New levels has been appeneded to this zoom course');

        $this->reloadPage();
    }

    public function appendUsersInZoomCourseLevel(Request $request)
    {
        $zoom_course_level_id = $request->input('zoom_course_level_id');
        $users_id = $request->input('users');

        $zoomCourseLevel = ZoomCourseLevel::where('id', $zoom_course_level_id)->first();
        
        for($i = 0; $i < count($users_id); $i++){

            $student = EnrolledStudentForZoomCourse::where('id', $users_id[$i])->first()->belongsToStudent;

            $data = [
                'email' => $student->email,
                'name' => $student->name,
                'zoom_course_level_title' => $zoomCourseLevel->title,
                'zoom_course_title' => $zoomCourseLevel->belongsToZoomCourse->title,
            ];
            
            // echo $users_id[$i],'<br>';
            $zoomCourseLevelUser = ZoomCourseLevelUser::firstOrCreate(['zoom_course_level_id' => $zoom_course_level_id, 'enrolled_for_zoom_course_id' => $users_id[$i]],[
                'zoom_course_level_id' => $zoom_course_level_id,
                'enrolled_for_zoom_course_id' => $users_id[$i],
            ]);

            foreach($zoomCourseLevel->sessions as $eachSession){

                ZoomCourseSessionUser::firstOrCreate(['zoom_course_level_user_id' => $zoomCourseLevelUser->id, 'zoom_course_session_id' => $eachSession->id],[
                    'zoom_course_level_user_id' => $zoomCourseLevelUser->id,
                    'zoom_course_session_id' => $eachSession->id
                ]);
            }

            Mail::send('mail.append-user-to-zoom-course-level', ['data' => $data], function ($message) use ($data) {
                $message->to( $data['email'] )
                ->from('streetenglishacademy@'.config('app.domain'), 'Street English')
                ->subject( 'You have joined level : '.$data['zoom_course_level_title'].' in '.$data['zoom_course_title'] );
            });
        }

        $this->successMsg('Users has been appened in this level');

        $this->reloadPage();
    }

    public function removeUserInZoomCourseLevel(Request $request)
    {
        $zoom_course_level_user_id = $request->input('zoom_course_level_user_id');

        ZoomCourseLevelUser::where('id', $zoom_course_level_user_id)->delete();

        $this->successMsg('This user has been removed from this level');
    }
    
    public function appendUsersInZoomCourseSession(Request $request)
    {
        $zoom_course_session_id = $request->input('zoom_course_session_id');
        $users_id = $request->input('users');
        
        for($i = 0; $i < count($users_id); $i++){

            // echo $users_id[$i],'<br>';
            ZoomCourseSessionUser::firstOrCreate(['zoom_course_session_id' => $zoom_course_session_id, 'zoom_course_level_user_id' => $users_id[$i]],[
                'zoom_course_session_id' => $zoom_course_session_id,
                'zoom_course_level_user_id' => $users_id[$i],
            ]);
        }

        $this->successMsg('Users has been appened in this session');

        $this->reloadPage();
    }

    public function updateLevelInfo(Request $request)
    {
        $zoom_course_level_id = $request->input('zoom_course_level_id');

        ZoomCourseLevel::where('id', $zoom_course_level_id)->update([
            'title' => $request->input('course_zoom_title'),
            'description' => $request->input('course_zoom_description'),
            'private_price' => $request->input('private_price'),
            'group_price' => $request->input('group_price'),
        ]);

        $this->successMsg('Zoom Course level details has been updated');

        $this->reloadPage();
    }

    public function appendNewLevelSession(Request $request)
    {
        $zoom_course_level_id = $request->input('zoom_course_level_id');
        $sessions = $request->input('sessions');

        for($i = 0; $i < count($sessions); $i++){

            ZoomCourseSession::where('zoom_course_level_id', $zoom_course_level_id)->firstOrCreate(['title' => $sessions[$i]['session_name'], 'slug' => $this->slugify($sessions[$i]['session_name'])], [
                'zoom_course_level_id' => $zoom_course_level_id,
                'title' => $sessions[$i]['session_name'],
                'slug' => $this->slugify($sessions[$i]['session_name'])
            ]);
        }

        $this->successMsg('New sessions has been appeneded to this level');

        $this->reloadPage();
    }

    public function deleteLevelSession(Request $request)
    {
        $zoom_course_level_session_id = $request->input('zoom_course_level_session_id');

        ZoomCourseSession::where('id', $zoom_course_level_session_id)->delete();

        $this->successMsg('This session has been removed from this level');
        
        $this->reloadPage();
    }

    public function updateLevelSessionInfo(Request $request)
    {
        $zoom_course_level_session_id = $request->input('zoom_course_level_session_id');

        ZoomCourseSession::where('id', $zoom_course_level_session_id)->update([
            'title' => $request->input('course_zoom_title'),
            'description' => $request->input('course_zoom_description'),
        ]);

        $this->successMsg('This session details has been updated');

        $this->reloadPage();
    }

    public function chooseSessionExercise(Request $request)
    {
        $zoom_course_level_session_id = $request->input('zoom_course_level_session_id');
        $exercise_id = $request->input('exercise_id');
        
        ZoomCourseSession::where('id', $zoom_course_level_session_id)->update([
            'exersice_id' => $exercise_id,
        ]);

        $this->successMsg('An MSQ Exercise has been selected for this session');

        $this->reloadPage();
    }
}

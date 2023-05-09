<?php

namespace App\Http\Controllers\Pages\ZoomCourses\ZoomCoursesUsers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\ZoomCourses\ZoomCourseUser;
use App\Models\ZoomCourses\ZoomCourseUserInfo;

class AjaxZoomCourseUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $zoomCourseUser = ZoomCourseUser::query();

        return Datatables::of($zoomCourseUser)
        ->editColumn('name', function ($zoomCourseUser) {
            return '<a href="'.route('zoom-course.user.show', [$zoomCourseUser->id]).'">'.$zoomCourseUser->name.'</a>';
        })
        ->editColumn('email', function ($zoomCourseUser) {
            return $zoomCourseUser->email;
        })
        ->editColumn('created_at', function ($zoomCourseUser) {
            return date("Y-m-d h:i:s a", strtotime($zoomCourseUser->created_at));
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function create(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repass = $request->input('repass');
        $about = $request->input('about');
        $title = $request->input('title');
        $facebook = $request->input('facebook');
        $twitter = $request->input('twitter');
        $linkedin = $request->input('linkedin');
        $image = $request->hasFile('image') ? 'user.'.$request->file('image')->getClientOriginalExtension() : null;

        // check if password greater than 6 characters
        if(strlen($password) < 6)
        {
            echo $this->errorMsg("Password must be equal or greater than 6 characters");
            die();
        }

        // check if password doesn't matched
        if($password != $repass)
        {
            echo $this->errorMsg("Password doesn't match");
            die();
        }
        
        // check if image has valid extesnion
        if($image != null && !$this->isFileExtAllowed(['jpg', 'jpeg', 'png'], $request->file('image')->getClientOriginalExtension()))
        {
            echo $this->errorMsg("user personal image extension not allowed");
            die();
        }
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        $zoomCourseUser = ZoomCourseUser::firstOrCreate(['email' => $email], $data);

        $zoom_course_user_info = [
            'title' => $title,
            'about' => $about,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'image' => $image
        ];

        ZoomCourseUserInfo::firstOrCreate(['live_course_user_id' => $zoomCourseUser->id], $zoom_course_user_info);

        if($zoomCourseUser)
        {
            $zoom_course_user_path = $this->getUniversalPath('public/images/zoom-course-users/'.$zoomCourseUser->id);

            $image != null ? $request->file('image')->move($zoom_course_user_path, 'user.'.$request->file('image')->getClientOriginalExtension()) : false;

            echo $this->successMsg("User : ".$name." has been added in our database");
            $this->redierctTo('zoom-course/user/show/'.$zoomCourseUser->id);
        }
    }

    public function updateInfo(Request $request)
    {
        $live_course_user_id = $request->input('live_course_user_id');

        $zoomCourseUser = ZoomCourseUser::where('id', $live_course_user_id)->first();

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repass = $request->input('repass');
        $whatsapp_number = $request->input('whatsapp_number');

        // check if coach's password will be updated
        if($password != null || $repass != null)
        {
            // check if password greater than 6 characters
            if(strlen($password) < 6)
            {
                echo $this->errorMsg("Password must be equal or greater than 6 characters");
                die();
            }

            // check if password greater than 6 characters
            if($password == null && strlen($password) < 6)
            {
                echo $this->errorMsg("Password must be equal or greater than 6 characters");
                die();
            }
    
            // check if password doesn't matched
            if($password != $repass)
            {
                echo $this->errorMsg("Password doesn't match");
                die();
            }

            $password = Hash::make($password);
        }
        else
        {
            $password = $zoomCourseUser->password;
        }

        ZoomCourseUser::where('id', $live_course_user_id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        ZoomCourseUserInfo::where('live_course_user_id', $live_course_user_id)->update([
            'whatsapp_number' => $whatsapp_number,
        ]);

        $this->successMsg("تم تحديث بيانات المستخدم");
        $this->reloadPage();
    }

    public function updateImage(Request $request)
    {
        $live_course_user_id = $request->input('live_course_user_id');

        $zoomCourseUserInfo = ZoomCourseUserInfo::where('live_course_user_id', $live_course_user_id)->first();

        $image = $request->file('image');

        $zoom_course_user_path = $this->getUniversalPath('public/images/zoom-course-users/'.$live_course_user_id);

        if($zoomCourseUserInfo == null)
        {
            // zoom course user image data
            $zoom_course_user_image_hash = md5(uniqid());
            $zoom_course_user_image = $zoom_course_user_image_hash.'.'.$image->getClientOriginalExtension();

            // create zoom course user image data
            ZoomCourseUserInfo::create([
                'live_course_user_id' => $live_course_user_id,
                'image' => $zoom_course_user_image,
            ]);

            // upload new image
            $this->uploadFile($request, 'image', $zoom_course_user_path, $zoom_course_user_image_hash);

            echo $this->successMsg("تم انشاء صورة جديدة للمدرب");
            $this->reloadPage();
        }
        else
        {
            if($zoomCourseUserInfo->image == null)
            {
                // zoom course user image data
                $zoom_course_user_image_hash = md5(uniqid());
                $zoom_course_user_image = $zoom_course_user_image_hash.'.'.$image->getClientOriginalExtension();

                // update zoom course user image data
                ZoomCourseUserInfo::where('live_course_user_id', $live_course_user_id)->update([
                    'image' => $zoom_course_user_image,
                ]);

                // upload new image
                $this->uploadFile($request, 'image', $zoom_course_user_path, $zoom_course_user_image_hash);

                echo $this->successMsg("تم انشاء صورة جديدة للمستخدم");
                $this->reloadPage();
            }
            else
            {
                // zoom course user image data
                $zoom_course_user_image_hash = md5(uniqid());
                $zoom_course_user_image = $zoom_course_user_image_hash.'.'.$image->getClientOriginalExtension();

                $old_image = $this->getUniversalPath('public/images/zoom-course-users/'.$zoomCourseUserInfo->live_course_user_id.'/'.$zoomCourseUserInfo->image);

                // delete old image
                file_exists($old_image) ? $this->removeFile($old_image) : true;
                
                // update zoom course user image data
                ZoomCourseUserInfo::where('live_course_user_id', $live_course_user_id)->update([
                    'image' => $zoom_course_user_image,
                ]);

                // upload new zoom course user image
                $this->uploadFile($request, 'image', $zoom_course_user_path, $zoom_course_user_image_hash);

                echo $this->successMsg("تم تحديث صورة جديدة للمدرب");
                $this->reloadPage();
            }
        }

        // $request->hasFile('image') ? $request->file('image')->move($zoom_course_user_path, 'coach.'.$request->file('image')->getClientOriginalExtension()) : false;

        // $this->reloadPage();
    }

    public function delete(Request $request)
    {
        $zoom_course_user_id = $request->input('zoom_course_user_id');

        $zoom_course_user_path = $this->getUniversalPath('public/images/zoom-course-users/'.$zoom_course_user_id);

        if(ZoomCourseUser::where('id', $zoom_course_user_id)->delete())
        {
            file_exists($zoom_course_user_path) ? $this->deleteDir($zoom_course_user_path) : true;

            $this->successMsg("This user has been removed");

            $this->redierctTo('zoom-course/user/create');
        }
    }
}

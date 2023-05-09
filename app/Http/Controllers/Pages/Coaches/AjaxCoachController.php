<?php

namespace App\Http\Controllers\Pages\Coaches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Models\Coaches\Coach;
use App\Models\Coaches\CoachInfo;

class AjaxCoachController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $coach = Coach::query();

        return Datatables::of($coach)
        ->editColumn('name', function ($coach) {
            return '<a href="'.route('coach.show', [$coach->id]).'">'.$coach->name.'</a>';
        })
        ->editColumn('delete_student', function ($coach) {
            return '<button class="btn btn-danger btn-sm deletecoach" data-coach-id="'.$coach->id.'">Delete coach</button>';
        })
        ->editColumn('created_at', function ($coach) {
            return date("Y-m-d h:i:s a", strtotime($coach->created_at));
        })
        ->editColumn('updated_at', function ($coach) {

            return $coach->created_at < $coach->updated_at ? '<span class="text-danger font-weight-bold">Updated at : '.date("Y-m-d h:i:s a", strtotime($coach->updated_at)).'</span>' : '<span class="text-success font-weight-bold">This coach hasn\'t been updated yet</span>';
        })
        ->rawColumns(['name', 'delete_student', 'updated_at'])
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
        $image = $request->hasFile('image') ? 'coach.'.$request->file('image')->getClientOriginalExtension() : null;

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
            echo $this->errorMsg("coach personal image extension not allowed");
            die();
        }
        
        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        $coach = Coach::firstOrCreate(['email' => $email], $data);

        $coach_info = [
            'title' => $title,
            'about' => $about,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'linkedin' => $linkedin,
            'image' => $image
        ];

        CoachInfo::firstOrCreate(['coach_id' => $coach->id], $coach_info);

        if($coach)
        {
            $coach_path = $this->getUniversalPath('public/public/images/coaches/'.$coach->id);

            $image != null ? $request->file('image')->move($coach_path, 'coach.'.$request->file('image')->getClientOriginalExtension()) : false;

            echo $this->successMsg("coach : ".$name." has been added in our database");
            $this->redierctTo('coach/show/'.$coach->id);
        }
    }

    public function updateInfo(Request $request)
    {
        $coach_id = $request->input('coach_id');

        $coach = Coach::where('id', $coach_id)->first();

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repass = $request->input('repass');

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
            $password = $coach->password;
        }

        Coach::where('id', $coach_id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);

        $title = $request->input('title');
        $about = $request->input('about');

        CoachInfo::where('coach_id', $coach_id)->update([
            'title' => $title,
            'about' => $about,
        ]);

        $this->successMsg("تم تحديث بيانات المدرب");
        $this->reloadPage();
    }

    public function updateSocialMedia(Request $request)
    {
        $coach_id = $request->input('coach_id');

        $coachInfo = CoachInfo::where('coach_id', $coach_id)->first();

        if($coachInfo == null)
        {
            // create coach info if not exists
            CoachInfo::create([
                'coach_id' => $coach_id,
                'facebook' => $request->input('facebook'),        
                'twitter' => $request->input('twitter'),        
                'linkedIn' => $request->input('linkedIn'),        
                'gmail' => $request->input('gmail'),        
                'whatsapp_number' => $request->input('whatsapp_number'),
            ]);
        }
        else
        {
            // update coach info
            $coachInfo->update([
                'facebook' => $request->input('facebook'),        
                'twitter' => $request->input('twitter'),        
                'linkedIn' => $request->input('linkedIn'),        
                'gmail' => $request->input('gmail'),        
                'whatsapp_number' => $request->input('whatsapp_number'),
            ]);
        }

        $this->successMsg("تم تحديث روابط التواصل الاجنماعي");
    }

    public function updateImage(Request $request)
    {
        $coach_id = $request->input('coach_id');

        $coachInfo = CoachInfo::where('coach_id', $coach_id)->first();

        $image = $request->file('image');

        $coach_path = $this->getUniversalPath('public/public/images/coaches/'.$coach_id);

        if($coachInfo == null)
        {
            // coach image data
            $coach_image_hash = md5(uniqid());
            $coach_image = $coach_image_hash.'.'.$image->getClientOriginalExtension();

            // create coach image data
            CoachInfo::create([
                'coach_id' => $coach_id,
                'image' => $coach_image,
            ]);

            // upload new image
            $this->uploadFile($request, 'image', $coach_path, $coach_image_hash);

            echo $this->successMsg("تم انشاء صورة جديدة للمدرب");
            $this->reloadPage();
        }
        else
        {
            if($coachInfo->image == null)
            {
                // coach image data
                $coach_image_hash = md5(uniqid());
                $coach_image = $coach_image_hash.'.'.$image->getClientOriginalExtension();

                // update coach image data
                CoachInfo::where('coach_id', $coach_id)->update([
                    'image' => $coach_image,
                ]);

                // upload new image
                $this->uploadFile($request, 'image', $coach_path, $coach_image_hash);

                echo $this->successMsg("تم انشاء صورة جديدة للمدرب");
                $this->reloadPage();
            }
            else
            {
                // coach image data
                $coach_image_hash = md5(uniqid());
                $coach_image = $coach_image_hash.'.'.$image->getClientOriginalExtension();

                // delete old image
                $this->removeFile($coach_path, $coachInfo->image);
                
                // update coach image data
                CoachInfo::where('coach_id', $coach_id)->update([
                    'image' => $coach_image,
                ]);

                // upload new coach image
                $this->uploadFile($request, 'image', $coach_path, $coach_image_hash);

                echo $this->successMsg("تم تحديث صورة جديدة للمدرب");
                $this->reloadPage();
            }
        }

        // $request->hasFile('image') ? $request->file('image')->move($coach_path, 'coach.'.$request->file('image')->getClientOriginalExtension()) : false;

        // $this->reloadPage();
    }

    public function permissionToMakeSessions(Request $request)
    {
        $coach_id = $request->input('data')['coach_id'];

        $coachInfo = CoachInfo::where('coach_id', $coach_id)->first();

        if($coachInfo == null)
        {
            CoachInfo::create([
                'coach_id' => $coach_id,
                'isAllowedForMakingSession' => 1,
            ]);

            $this->successMsg("تم تفعيل صلاحية انشاء جلسات");
        }
        else
        {
            CoachInfo::where('coach_id', $coach_id)->update([
                'isAllowedForMakingSession' => $coachInfo->isAllowedForMakingSession == 1 ? 0 : 1,
            ]);

            $this->successMsg($coachInfo->isAllowedForMakingSession == 1 ? "تم الغاء صلاحية انشاء الجلسات" : "تم تفعيل صلاحية انشاء جلسات");
        }

    }

    public function permissionToPublishCourses(Request $request)
    {
        $coach_id = $request->input('data')['coach_id'];

        $coachInfo = CoachInfo::where('coach_id', $coach_id)->first();

        if($coachInfo == null)
        {
            CoachInfo::create([
                'coach_id' => $coach_id,
                'isAllowedForPublishCourses' => 1,
            ]);

            $this->successMsg("تم تفعيل صلاحية انشاء دورات تدريبية");
        }
        else
        {
            CoachInfo::where('coach_id', $coach_id)->update([
                'isAllowedForPublishCourses' => $coachInfo->isAllowedForPublishCourses == 1 ? 0 : 1,
            ]);
    
            $this->successMsg($coachInfo->isAllowedForPublishCourses == 1 ? "تم الغاء صلاحية انشاء دورات تدريبية" : "تم تفعيل صلاحية انشاء دورات تدريبية");
        }
    }

    public function permissionToPublishBlogs(Request $request)
    {
        $coach_id = $request->input('data')['coach_id'];

        $coachInfo = CoachInfo::where('coach_id', $coach_id)->first();

        if($coachInfo == null)
        {
            CoachInfo::create([
                'coach_id' => $coach_id,
                'isAllowedForPublishBlogs' => 1,
            ]);

            $this->successMsg("تم تفعيل صلاحية انشاء بلوجات");
        }
        else
        {
            CoachInfo::where('coach_id', $coach_id)->update([
                'isAllowedForPublishBlogs' => $coachInfo->isAllowedForPublishBlogs == 1 ? 0 : 1,
            ]);
    
            $this->successMsg($coachInfo->isAllowedForPublishBlogs == 1 ? "تم الغاء صلاحية انشاء بلوجات" : "تم تفعيل صلاحية انشاء بلوجات");
        }
    }

    public function delete(Request $request)
    {
        $coach_id = $request->input('coach_id');

        $coach_path = $this->getUniversalPath('image/coaches/'.$coach_id);

        if(Coach::where('id', $coach_id)->delete())
        {
            file_exists($coach_path) ? $this->deleteDir($coach_path) : true;

            $this->successMsg("This coach has been removed");

            $this->redierctTo('coaches');
        }
    }
}

<?php

namespace App\Http\Controllers\IeltsUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bundles\BundleUser;
use App\Models\EnrolledStudents\EnrolledStudentForIETLSCourse;
use App\Models\IETLSCourses\IeltsUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ielts_user.auth:ielts_user');
    }

    /**
     * Show the IeltsUser dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::guard('ielts_user')->user()->id;
        
        $myBundles = BundleUser::where('user_id', $user_id)->get();
        $myCourses = EnrolledStudentForIETLSCourse::where('ielts_user_id', $user_id)->get();
        
        return view('ielts-user.home')
        ->with('myBundles', $myBundles)
        ->with('myCourses', $myCourses);
    }

    public function settings()
    {
        $user = IeltsUser::where('id', Auth::guard('ielts_user')->user()->id)->first();

        return view('ielts-user.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $user = IeltsUser::where('id', Auth::guard('ielts_user')->user()->id)->first();

        !Hash::check($old_password, $user->password) ? $this->errorMsg('Old password is incorrect') : true;

        $new_password != $confirm_password ? $this->errorMsg("Password don't matched") : true;

        $user->update([
            'password' => Hash::make($new_password)
        ]);

        Auth::logout();

        $this->successMsg('Your Password has been changed');

        $this->reloadPage();
    }
    
    public function updateImage(Request $request)
    {
        $user = IeltsUser::where('id', Auth::guard('ielts_user')->user()->id)->first();

        if($request->hasFile('image')){
            
            !in_array($request->file('image')->getClientOriginalExtension(), ['jpeg', 'png', 'jpg']) ? $this->errorMsg('Your profile image extension is not valid') : true;

            // check if user has image
            $old_image = $this->getUniversalPath('public/public/images/ielts-user/'.$user->id.'/'.$user->image);

            // remove image if exists
            file_exists($old_image) ? $this->removeFile($old_image) : true;

            // get user image
            $user_image_path = $this->getUniversalPath('public/public/images/ielts-user/'.$user->id);

            // get new image name
            $image_name = md5(uniqid());

            // upload new image
            $this->uploadFile($request, 'image', $user_image_path, $image_name);

            // update image data in user database
            $user->update([
                'image' => $image_name.'.'.$request->file('image')->getClientOriginalExtension(),
            ]);

            $this->successMsg('Image has been updated');

            $this->reloadPage();
        }
    }
}

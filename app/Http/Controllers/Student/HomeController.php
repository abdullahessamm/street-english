<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Bundles\BundleUser;
use App\Models\EnrolledStudents\EnrolledStudentForCourse;
use App\User;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;

        $myBundles = BundleUser::where('user_id', $user_id)->get();
        $myCourses = EnrolledStudentForCourse::where('user_id', $user_id)->get();

        return view('student.home')
        ->with('myBundles', $myBundles)
        ->with('myCourses', $myCourses);
    }

    public function settings()
    {
        return view('student.settings');
    }

    public function updatePassword(Request $request)
    {
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');
        $confirm_password = $request->input('confirm_password');

        $user = User::where('id', Auth::user()->id)->first();

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
        $user = User::where('id', Auth::user()->id)->first();

        if($request->hasFile('image')){
            
            !in_array($request->file('image')->getClientOriginalExtension(), ['jpeg', 'png', 'jpg']) ? $this->errorMsg('Your profile image extension is not valid') : true;

            // check if user has image
            $old_image = $this->getUniversalPath('public/public/images/students/'.$user->id.'/'.$user->image);

            // remove image if exists
            file_exists($old_image) ? $this->removeFile($old_image) : true;

            // get user image
            $user_image_path = $this->getUniversalPath('public/public/images/students/'.$user->id);

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

<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;

class AjaxSettingsController extends Controller
{
    public function changeUserName(Request $request)
    {
        $name = $request->input('user_name');

        User::first()->update([
            'name' => $name
        ]);

        echo $this->successMsg("Your name has been updated");
    }

    public function changePassword(Request $request)
    {
        $user_old_password = $request->input('user_old_password');
        $user_new_password = $request->input('user_new_password');
        $confirm_password = $request->input('confirm_password');

        $admin =  User::first();

        // check if old password is valid
        if(!Hash::check($user_old_password, $admin->password))
        {
            echo $this->errorMsg("Old password is incorrect");
            die();
        }

        // check if the new password doesn't have less than 6 characters
        if(\strlen($user_new_password) < 6)
        {
            echo $this->errorMsg("Please make your password greater than 6 characters");
            die();
        }
        else
        {
            // check if new password is confirmed
            if($user_new_password !== $confirm_password)
            {
                echo $this->errorMsg("Password doesn't matched");
                die();
            }

            // check if the old password not equal to the new password
            if(Hash::check($user_new_password, $admin->password))
            {
                echo $this->errorMsg("This password has been used before, Please choose a new one");
                die();
            }


            // update admin password in the database
            User::first()->update([
                'password' => Hash::make($user_new_password)
            ]);
    
            echo $this->successMsg("Password has been updated");

            // force logout
            Auth::logout();

            // reload page
            $this->reloadPage();
        }
    }

    public function changeEmail(Request $request)
    {
        $admin =  User::first();

        $user_email = $request->input('user_email');

        if($admin->email == $user_email)
        {
            echo $this->errorMsg("This is your current email account, Please choose another one.");
            die();
        }

        User::first()->update([
            'email' => $user_email
        ]);

        echo $this->successMsg("Your email has been updated");

        // force logout
        Auth::logout();

        // reload page
        $this->reloadPage();
    }

    public function changeUserImage(Request $request)
    {
        $user_id = Auth::user()->id;

        $userImage = $request->file('user_image');

        if(!$this->isFileExtAllowed(['jpeg', 'jpg', 'png'], $userImage->getClientOriginalExtension()))
        {
            echo $this->errorMsg("Image extension is not allowed, Please choose another one.");
            die();
        }

        $admin_path = $this->getUniversalPath('public/images/admin');

        if($userImage->move($admin_path, 'admin.'.$userImage->getClientOriginalExtension()))
        {
            User::where('id', $user_id)->update([
                'image' => 'admin.'.$userImage->getClientOriginalExtension()
            ]);

            echo $this->successMsg("Your image has been updated");
        }
    }
}
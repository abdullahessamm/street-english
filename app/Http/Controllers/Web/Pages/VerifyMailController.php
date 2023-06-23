<?php

namespace App\Http\Controllers\Web\Pages;

use App\Http\Controllers\Web\Controller;
use App\Models\Students\Student;
use Illuminate\Http\Request;
use Throwable;

class VerifyMailController extends Controller
{
    public function verify(Request $request, $userId)
    {
        $user = Student::findOrFail($userId);

        try {
            $request->validate([
                'token' => 'required|string'
            ]);
        } catch(Throwable $e) {
            return redirect('/');
        };

        $verified = false;
        $errMsg = "Can't Verify this email, ";
        $redirect = route('recordedStudent.home');

        if ($user->emailVerified())
            $verified = true;

        else if (! $user->hasEmailToken())
            $errMsg .= 'No validate request sent!';

        else if ($user->emailTokenExpired())
            $errMsg .= 'The token expired!';

        else if (! $user->verifyEmail($request->token))
            $errMsg .= 'Invalid token!';

        else 
            $verified = true;

        return view('web.pages.verify-mail')
            ->with('verified', $verified)
            ->with('errMsg', $errMsg)
            ->with('redirect', $redirect);
    }
}
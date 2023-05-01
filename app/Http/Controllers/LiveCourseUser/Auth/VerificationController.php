<?php

namespace App\Http\Controllers\LiveCourseUser\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | live_course_user that recently registered with the application. Emails may also
    | be re-sent if the live_course_user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect live_course_users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/live_course_user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('live-course-user.auth');
        $this->middleware('signed')->only('live-course-user.verify');
        $this->middleware('throttle:6,1')->only('live-course-user.verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return $request->user('live-course-user')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('live-course-user.auth.verify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        if (! hash_equals((string) $request->route('id'), (string) $request->user('live-course-user')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('live-course-user')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('live-course-user')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('live-course-user')->markEmailAsVerified()) {
            event(new Verified($request->user('live-course-user')));
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        if ($request->user('live-course-user')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('live-course-user')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}

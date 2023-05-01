<?php

namespace App\Http\Controllers\IeltsUser\Auth;

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
    | ielts_user that recently registered with the application. Emails may also
    | be re-sent if the ielts_user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect ielts_users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/ielts_user';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('ielts-user.auth');
        $this->middleware('signed')->only('ielts-user.verify');
        $this->middleware('throttle:6,1')->only('ielts-user.verify', 'resend');
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
        return $request->user('ielts-user')->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('ielts-user.auth.verify');
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
        if (! hash_equals((string) $request->route('id'), (string) $request->user('ielts-user')->getKey())) {
            throw new AuthorizationException;
        }

        if (! hash_equals((string) $request->route('hash'), sha1($request->user('ielts-user')->getEmailForVerification()))) {
            throw new AuthorizationException;
        }

        if ($request->user('ielts-user')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        if ($request->user('ielts-user')->markEmailAsVerified()) {
            event(new Verified($request->user('ielts-user')));
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
        if ($request->user('ielts-user')->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }

        $request->user('ielts-user')->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }
}

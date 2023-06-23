<?php

namespace App\Http\Controllers\Auth\RecordedStudent;

use Illuminate\Support\Str;
use App\Models\Students\Student;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\AbstractLoginController;

class LoginController extends AbstractLoginController
{

    protected string $loginRedirectRoute = 'recordedStudent.home';
    protected string $logoutRedirectRoute = 'recordedStudent.login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web:recordedStudent,recordedStudent.home')->except('logout');
        $this->guard = auth()->guard('web:recordedStudent');
    }

    /**
     * redirect to google page login
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function loginWithGoogleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            if (! $user)
                return redirect('/');
    
            $student = Student::updateOrCreate([
                'email' => $user->email
            ], [
                'google_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make(Str::random()),
                'email_verified_at' => now()
            ]);
            
            auth('web:recordedStudent')->login($student, true);
            $token = $student->createToken(get_class($user) . '-' . $user->id . '-web-access');
            return redirect()->route($this->loginRedirectRoute)->withCookie(cookie('token', $token->plainTextToken, 60*24*365*80, null, config('session.domain'), null, false));

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            return redirect('/');
        }
    }
}

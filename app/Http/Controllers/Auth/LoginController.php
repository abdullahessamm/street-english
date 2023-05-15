<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Models\ApiToken;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * overrid default login function to create api token while logging in
     *
     * @param Request $req
     */
    public function login(Request $req) {
        if (auth()->attempt(['email' => $req->email, 'password' => $req->password], true)) {
            $admin = auth()->user();
            $token = $admin->createToken('admin-' . $admin->id . '-web-access');
            return redirect()->route('home')->withCookie(cookie('token', $token->plainTextToken, 60*24*365*80, null, null, null, false));
        }

        if (Admin::where('email', $req->email)->first())
            return back()->withErrors(['password' => 'Wrong password.']);
        else 
            return back()->withErrors(['email' => 'Email not found in our database.']);
    }

    /**
     * overrid default logout function to remove api token while logging out
     *
     * @param Request $req
     */
    public function logout(Request $request)
    {
        auth()->logout();

        if ($request->hasCookie('token')) {
            $token = ApiToken::findToken($request->cookie('token'));
            $token ? $token->delete() : null;
        }

        return redirect()->route('login')->withCookie(cookie('token', null, 0, null, null, null, false));
    }
}

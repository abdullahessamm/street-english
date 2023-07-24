<?php 

namespace App\Http\Controllers\Auth;

use App\Admin;
use App\Models\ApiToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

abstract class AbstractLoginController extends Controller
{
    use AuthenticatesUsers;

    protected StatefulGuard $guard;
    protected string $loginRedirectRoute;
    protected string $logoutRedirectRoute;

    /**
     * overrid default login function to create api token while logging in
     *
     * @param Request $req
     */
    public function login(Request $req) {
        if ($this->guard->attempt(['email' => $req->email, 'password' => $req->password], true)) {
            $user = $this->guard->user();
            $modelName = strtolower(array_reverse(explode('\\', get_class($user)))[0]);
            $token = $user->createToken($modelName . '-' . $user->id . '-web-access');
            return redirect()->route($this->loginRedirectRoute)->withCookie(cookie("$modelName-token", $token->plainTextToken, 60*24*365*80, null, config('session.domain'), null, false));
        }

        if ($this->guard->getProvider()->retrieveByCredentials(['email' => $req->email]))
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
        $this->guard->logout();
        $this->deleteToken($request);

        return redirect()->route($this->logoutRedirectRoute)->withCookie(cookie('token', null, 0, null, config('session.domain'), null, false));
    }

    private function deleteToken(Request $request)
    {
        $model = $this->guard->getProvider()->getModel();
        $modelName = strtolower(array_reverse(explode('\\', $model))[0]);


        if ($request->hasCookie("$modelName-token")) {
            $token = ApiToken::findToken($request->cookie("$modelName-token"));
            $token ? $token->delete() : null;
        }
    }
}
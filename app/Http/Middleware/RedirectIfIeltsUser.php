<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfIeltsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'ielts_user')
    {
        if (Auth::guard($guard)->check()) {
            return redirect()->route('ielts-user.home');
        }

        return $next($request);
    }

}

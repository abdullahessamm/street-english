<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, $guard, $redirectTo=null)
    {
        if (auth($guard)->check())
            return $next($request);

        if ($request->wantsJson())
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        
        return redirect(route($redirectTo ?? 'index'));
    }

}

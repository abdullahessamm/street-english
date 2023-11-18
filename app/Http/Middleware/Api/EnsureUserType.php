<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Exceptions\Authorization\UnauthorizedException;
use Illuminate\Http\Response;

abstract class EnsureUserType
{
    /**
     * @return User
     */
    abstract protected function getAuthModel(): User;

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     * @throws UnauthorizedException
     */
    public function handle(Request $request, Closure $next)
    {
        if (get_class(auth('sanctum')->user()) === get_class($this->getAuthModel()))
            return $next($request);

        throw new UnauthorizedException();
    }
}

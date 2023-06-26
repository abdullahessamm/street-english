<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\Authorization\UnauthorizedException;

abstract class EnsureUserType
{
    /**
     * user's model class name
     *
     * @var string
     */
    protected string $modelName = '';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (get_class(auth('sanctum')->user()) === $this->modelName)
            return $next($request);

        throw new UnauthorizedException();
    }
}

<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'ielts_user.auth' => \App\Http\Middleware\RedirectIfNotIeltsUser::class,
        'ielts_user.guest' => \App\Http\Middleware\RedirectIfIeltsUser::class,
        // 'ielts_user.verified' => \App\Http\Middleware\EnsureIeltsUserEmailIsVerified::class,
        // 'ielts_user.password.confirm' => \App\Http\Middleware\RequireIeltsUserPassword::class,
        'ielts-user.auth' => \App\Http\Middleware\RedirectIfNotIeltsUser::class,
        'ielts-user.guest' => \App\Http\Middleware\RedirectIfIeltsUser::class,
        // 'ielts-user.verified' => \App\Http\Middleware\EnsureIeltsUserEmailIsVerified::class,
        // 'ielts-user.password.confirm' => \App\Http\Middleware\RequireIeltsUserPassword::class,
        'live_course_user.auth' => \App\Http\Middleware\RedirectIfNotLiveCourseUser::class,
        'live_course_user.guest' => \App\Http\Middleware\RedirectIfLiveCourseUser::class,
        // 'live_course_user.verified' => \App\Http\Middleware\EnsureLiveCourseUserEmailIsVerified::class,
        // 'live_course_user.password.confirm' => \App\Http\Middleware\RequireLiveCourseUserPassword::class,
        'coach.auth' => \App\Http\Middleware\RedirectIfNotCoach::class,
        'coach.guest' => \App\Http\Middleware\RedirectIfCoach::class,
        // 'coach.verified' => \App\Http\Middleware\EnsureCoachEmailIsVerified::class,
        // 'coach.password.confirm' => \App\Http\Middleware\RequireCoachPassword::class,
        'admin.auth' => \App\Http\Middleware\RedirectIfNotAdmin::class,
        'admin.guest' => \App\Http\Middleware\RedirectIfAdmin::class,
        // 'admin.verified' => \App\Http\Middleware\EnsureAdminEmailIsVerified::class,
        // 'admin.password.confirm' => \App\Http\Middleware\RequireAdminPassword::class,
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}

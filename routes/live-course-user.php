<?php

use App\LiveCourseUser;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'LiveCourseUser'], function() {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('live-course-user.home');

    // Settings
    Route::get('/settings', 'HomeController@settings')->name('live-course-user.settings');
    Route::post('/ajax/settings/update-password', 'HomeController@updatePassword')->name('live-course-user.ajax.settings.update-password');
    Route::post('/ajax/settings/update-image', 'HomeController@updateImage')->name('live-course-user.ajax.settings.update-image');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('live-course-user.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('live-course-user.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('live-course-user.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('live-course-user.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('live-course-user.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('live-course-user.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('live-course-user.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('live-course-user.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // zoom courses pages
    Route::get('/live-course/show/{slug}', 'HomeController@liveCourse')->name('live-course.show');
    Route::get('/live-course/show/{slug}/level/show/{level_id}', 'HomeController@liveCourseLevel')->name('live-course.level.show');
    Route::get('/live-course/show/{slug}/level/show/{level_id}/session/show/{session_id}', 'HomeController@liveCourseLevelSession')->name('live-course-user.session.show');
    Route::post('/ajax/start-session-exersice', 'HomeController@startSessionExersice')->name('ajax.start-session-exersice');
    Route::post('/ajax/submit-session-exersice', 'HomeController@submitSessionExersice')->name('ajax.submit-session-exersice');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('live-course-user.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('live-course-user.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('live-course-user.verification.resend');
});

// factory(LiveCourseUser::class, 10)->create();
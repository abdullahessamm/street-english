<?php

use App\Coach;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Coach'], function() {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('coach.home');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('coach.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('coach.logout');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('coach.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('coach.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('coach.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('coach.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('coach.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('coach.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('coach.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('coach.verification.resend');

    // My Courses
    Route::get('/my-courses', 'Pages\MyCourses\MyCourseController@index')->name('coach.my-courses');
    Route::get('/my-course/show/{slug}', 'Pages\MyCourses\MyCourseController@show')->name('coach.my-course.show');
    Route::get('/my-course/create', 'Pages\MyCourses\MyCourseController@create')->name('coach.my-course.create');
    Route::post('/ajax/my-course/create', 'Pages\MyCourses\AjaxMyCourseController@create')->name('coach.ajax.my-course.create');
    Route::post('/ajax/my-course/update', 'Pages\MyCourses\AjaxMyCourseController@update')->name('coach.ajax.my-course.update');
    Route::post('/ajax/my-course/delete', 'Pages\MyCourses\AjaxMyCourseController@delete')->name('coach.ajax.my-course.delete');
    Route::post('/ajax/my-course/preview-media-type', 'Pages\MyCourses\AjaxMyCourseController@previewMediaType')->name('coach.ajax.my-courses.preview.media-intro-type');
    Route::post('/ajax/my-course/preview-current-intro-media', 'Pages\MyCourses\AjaxMyCourseController@previewCurrentIntroMedia')->name('coach.ajax.my-courses.preview.current-media-intro');
    Route::post('/ajax/my-course/content/create', 'Pages\MyCourses\AjaxMyCourseController@createContent')->name('coach.ajax.my-course.content.create');
    Route::post('/ajax/my-course/content/title/update', 'Pages\MyCourses\AjaxMyCourseController@updateContentTitle')->name('coach.ajax.my-course.content.title.update');
    Route::post('/ajax/my-course/content/description/update', 'Pages\MyCourses\AjaxMyCourseController@updateContentDescription')->name('coach.ajax.my-course.content.title.description');
    Route::post('/ajax/my-course/content/description/delete', 'Pages\MyCourses\AjaxMyCourseController@deleteContent')->name('coach.ajax.my-course.content.title.delete');
    Route::post('/ajax/my-course/content/lesson/create', 'Pages\MyCourses\AjaxMyCourseController@createLesson')->name('coach.ajax.my-course.content.lesson.create');
    Route::post('/ajax/my-course/content/lesson/title/update', 'Pages\MyCourses\AjaxMyCourseController@updateLessonTitle')->name('coach.ajax.my-course.content.lesson.title.update');
    Route::post('/ajax/my-course/content/lesson/video/update', 'Pages\MyCourses\AjaxMyCourseController@updateVideo')->name('coach.ajax.my-course.content.lesson.video.update');
    Route::post('/ajax/my-course/content/lesson/preview', 'Pages\MyCourses\AjaxMyCourseController@previewLesson')->name('coach.ajax.my-course.content.lesson.preview');
    Route::post('/ajax/my-course/content/lesson/lock-or-unlock', 'Pages\MyCourses\AjaxMyCourseController@lockOrUnlockLesson')->name('coach.ajax.my-course.content.lesson.lock-or-unlock');
    Route::post('/ajax/my-course/content/lesson/delete', 'Pages\MyCourses\AjaxMyCourseController@deleteLesson')->name('coach.ajax.my-course.content.lesson.delete');
    
    // My Sessions
    Route::get('/my-sessions', 'Pages\MySessions\MySessionController@index')->name('coach.my-sessions');
    Route::get('/my-session/{slug}', 'Pages\MySessions\MySessionController@show')->name('coach.my-session.show');
    Route::get('/my-session/{my_session_slug}/date/{slug}', 'Pages\MySessions\MySessionController@date')->name('coach.my-session.date');
    Route::get('/my-session/{my_session_slug}/date/{date_slug}/appointment/{slug}', 'Pages\MySessions\MySessionController@appointment')->name('coach.my-session.appointment');
    Route::post('/ajax/my-session/create', 'Pages\MySessions\AjaxMySessionController@create')->name('coach.ajax.my-session.create');
    Route::post('/ajax/my-session/update', 'Pages\MySessions\AjaxMySessionController@update')->name('coach.ajax.my-session.update');
    Route::post('/ajax/my-session/delete', 'Pages\MySessions\AjaxMySessionController@delete')->name('coach.ajax.my-session.delete');
    Route::post('/ajax/my-session/date/create', 'Pages\MySessions\AjaxMySessionController@createDate')->name('coach.ajax.my-session.date.create');
    Route::post('/ajax/my-session/date/delete', 'Pages\MySessions\AjaxMySessionController@deleteDate')->name('coach.ajax.my-session.date.delete');
    Route::post('/ajax/my-session/date/appointment/create', 'Pages\MySessions\AjaxMySessionController@createAppointment')->name('coach.ajax.my-session.date.appointment.create');
    Route::post('/ajax/my-session/date/appointment/delete', 'Pages\MySessions\AjaxMySessionController@deleteAppointment')->name('coach.ajax.my-session.date.appointment.delete');
    
    // My Blogs
    Route::get('/my-blogs', 'Pages\MyBlogs\MyBlogController@index')->name('coach.my-blogs');
    Route::get('/my-blog/show/{slug}', 'Pages\MyBlogs\MyBlogController@show')->name('coach.my-blog.show');
    Route::get('/my-blog/create', 'Pages\MyBlogs\MyBlogController@create')->name('coach.my-blog.create');
    Route::post('/ajax/my-blog/create', 'Pages\MyBlogs\AjaxMyBlogController@create')->name('coach.ajax.my-blog.create');
    Route::post('/ajax/my-blog/delete', 'Pages\MyBlogs\AjaxMyBlogController@delete')->name('coach.ajax.my-blog.delete');
    Route::post('/ajax/my-blog/preview-media-type', 'Pages\MyBlogs\AjaxMyBlogController@previewMediaType')->name('coach.ajax.my-blog.preview.media-intro-type');
    Route::post('/ajax/my-blog/preview-current-intro-media', 'Pages\MyBlogs\AjaxMyBlogController@previewCurrentIntroMedia')->name('coach.ajax.my-blog.preview.current-media-intro');

});

// factory(Coach::class, 10)->create();

/*Coach::create([
    'name' => 'Dr. John Doe',
    'email' => 'johndoe@'.config('app.domain'),
    'password' => Hash::make('secret123'),
    'image' => null
]);*/
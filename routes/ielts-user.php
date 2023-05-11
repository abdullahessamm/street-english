<?php
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'IeltsUser'], function() {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('ielts-user.home');

    // Settings
    Route::get('/settings', 'HomeController@settings')->name('ielts.settings');
    Route::post('/ajax/settings/update-password', 'HomeController@updatePassword')->name('ielts-user.ajax.settings.update-password');
    Route::post('/ajax/settings/update-image', 'HomeController@updateImage')->name('ielts-user.ajax.settings.update-image');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('ielts-user.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('ielts-user.logout');

    // Register
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('ielts-user.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('ielts-user.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('ielts-user.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('ielts-user.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('ielts-user.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('ielts-user.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('ielts-user.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('ielts-user.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('ielts-user.verification.resend');

    Route::get('/settings', 'HomeController@settings')->name('ielts-user.settings');

    // My Courses
    Route::get('/my-courses', 'MyCourses\MyCourseController@index')->name('ielts-user.my-courses');
    Route::get('/my-course/{slug}', 'MyCourses\MyCourseController@show')->name('ielts-user.my-course.show');
    Route::get('/my-course/{my_course_slug}/lesson/{slug}', 'MyCourses\MyCourseController@lesson')->name('ielts-user.my-course.lesson');
    Route::get('/my-course/{slug}/suspend', 'MyCourses\MyCourseController@suspend')->name('ielts-user.my-course.suspend');
    Route::post('ajax/student/my-course/course/start','MyCourses\AjaxMyCourseController@finishLesson')->name('ajax.my-course.start');
    Route::post('ajax/student/my-course/display-lesson','MyCourses\AjaxMyCourseController@displayLesson')->name('ajax.ielts-user.my-course.display-lesson');
    Route::post('ajax/student/my-course/lesson/next','MyCourses\AjaxMyCourseController@nextLesson')->name('ajax.ielts-user.my-course.lesson.next');
    Route::post('ajax/student/my-course/lesson/finish','MyCourses\AjaxMyCourseController@finishLesson')->name('ajax.ielts-user.my-course.lesson.finish');

    // My Bundles
    Route::get('/my-bundles', 'MyBundles\MyBundleController@index')->name('ielts-user.my-bundles');
    Route::get('/my-bundle/show/{slug}', 'MyBundles\MyBundleController@show')->name('ielts-user.my-bundle.show');

    // My Sessions
    Route::get('/my-sessions', 'MySessions\MySessionController@index')->name('ielts-user.my-sessions');
    Route::get('/my-session/{slug}', 'MySessions\MySessionController@show')->name('ielts-user.my-session.show');

    // My Exams
    Route::get('/my-exams', 'MyExams\MyExamController@index')->name('ielts-user.my-exams');
    Route::get('/my-exam/{slug}', 'MyExams\MyExamController@show')->name('ielts-user.my-exam.show');
});

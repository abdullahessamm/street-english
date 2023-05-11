<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Student'], function() {
    // Dashboard
    Route::get('/home', 'HomeController@index')->name('student.home');

    // Settings
    Route::get('/settings', 'HomeController@settings')->name('student.settings');
    Route::post('/ajax/settings/update-password', 'HomeController@updatePassword')->name('student.ajax.settings.update-password');
    Route::post('/ajax/settings/update-image', 'HomeController@updateImage')->name('student.ajax.settings.update-image');

    // My Courses
    Route::get('/my-courses', 'MyCourses\MyCourseController@index')->name('student.my-courses');
    Route::get('/my-course/{slug}', 'MyCourses\MyCourseController@show')->name('student.my-course.show');
    Route::get('/my-course/{my_course_slug}/lesson/{slug}', 'MyCourses\MyCourseController@lesson')->name('student.my-course.lesson');
    Route::get('/my-course/{slug}/suspend', 'MyCourses\MyCourseController@suspend')->name('student.my-course.suspend');
    Route::post('ajax/student/my-course/course/start','MyCourses\AjaxMyCourseController@finishLesson')->name('ajax.student.my-course.start');
    Route::post('ajax/student/my-course/display-lesson','MyCourses\AjaxMyCourseController@displayLesson')->name('ajax.student.my-course.display-lesson');
    Route::post('ajax/student/my-course/lesson/next','MyCourses\AjaxMyCourseController@nextLesson')->name('ajax.student.my-course.lesson.next');
    Route::post('ajax/student/my-course/lesson/finish','MyCourses\AjaxMyCourseController@finishLesson')->name('ajax.student.my-course.lesson.finish');
    Route::post('ajax/student/my-course/lesson/exercise/finish','MyCourses\AjaxMyCourseController@finishLessonExercise')->name('ajax.student.my-course.lesson.exercise.finish');
    

    // My Bundles
    Route::get('/my-bundles', 'MyBundles\MyBundleController@index')->name('student.my-bundles');
    Route::get('/my-bundle/show/{slug}', 'MyBundles\MyBundleController@show')->name('student.my-bundle.show');

    // My Sessions
    Route::get('/my-sessions', 'MySessions\MySessionController@index')->name('student.my-sessions');
    Route::get('/my-session/{slug}', 'MySessions\MySessionController@show')->name('student.my-session.show');

    // My Exams
    Route::get('/my-exams', 'MyExams\MyExamController@index')->name('student.my-exams');
    Route::get('/my-exam/{slug}', 'MyExams\MyExamController@show')->name('student.my-exam.show');

});


// factory(User::class, 10)->create();

/*User::create([
    'name' => 'Soheil Salah',
    'email' => 'soheilsalah2@gmail.com',
    'password' => Hash::make('secret123'),
    'image' => null
]);*/
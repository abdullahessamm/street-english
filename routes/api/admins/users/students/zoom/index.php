<?php

use App\Http\Controllers\Api\Admins\Users\Students\Zoom\ZoomCourseStudentCoursesController;
use App\Http\Controllers\Api\Admins\Users\Students\Zoom\ZoomCourseStudentsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')
    ->controller(ZoomCourseStudentsController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoomCourseStudents.php');

Route::prefix('{id}/courses')
    ->where(['id' => '^[0-9]+$'])
    ->controller(ZoomCourseStudentCoursesController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoomCourseStudentCourses.php');

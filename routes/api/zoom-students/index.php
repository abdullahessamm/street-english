<?php

use App\Http\Controllers\Api\ZoomStudents\CoursesController;
use App\Http\Controllers\Api\ZoomStudents\ExamsController;
use App\Http\Controllers\Api\ZoomStudents\ExercisesController;
use App\Http\Controllers\Api\ZoomStudents\ReportsController;
use Illuminate\Support\Facades\Route;

// Courses
Route::prefix('courses')
    ->controller(CoursesController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses.php');

// reports
Route::prefix('reports')
    ->controller(ReportsController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'reports.php');

// account
Route::prefix('account')
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'account' . DIRECTORY_SEPARATOR . 'index.php');

// exercises
Route::prefix('exercises')
    ->controller(ExercisesController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'exercises.php');

// exams
Route::prefix('exams')
    ->controller(ExamsController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'exams.php');

//media
Route::prefix('media')
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . 'index.php');

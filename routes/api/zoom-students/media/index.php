<?php

use Illuminate\Support\Facades\Route;

// account
Route::prefix('account')
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'account' . DIRECTORY_SEPARATOR . 'index.php');

// courses
Route::prefix('courses')
    ->controller(\App\Http\Controllers\Api\ZoomStudents\Media\CoursesMediaController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses.php');

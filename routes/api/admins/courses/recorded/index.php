<?php

use App\Http\Controllers\Api\Admins\Courses\RecordedCourses\CourseController;
use App\Http\Controllers\Api\Admins\Courses\RecordedCourses\RecordedCoursesCategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', RecordedCoursesCategoryController::class);
Route::apiResource('', CourseController::class);
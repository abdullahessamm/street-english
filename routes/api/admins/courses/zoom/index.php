<?php

use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\CourseController;
use Illuminate\Support\Facades\Route;

Route::prefix('courses')
->controller(CourseController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses.php');
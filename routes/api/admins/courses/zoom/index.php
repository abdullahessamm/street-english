<?php

use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\CourseController;
use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\GroupsController;
use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\LevelController;
use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\PrivatesController;
use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\RelatedDataController;
use App\Http\Controllers\Api\Admins\Courses\ZoomCourses\SessionController;
use Illuminate\Support\Facades\Route;

// courses
Route::prefix('courses')
->controller(CourseController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses.php');

// levels
Route::prefix('levels')
->controller(LevelController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'levels.php');

// groups
Route::prefix('groups')
->controller(GroupsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'groups.php');

// private
Route::prefix('privates')
->controller(PrivatesController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . "privates.php");

// sessions
Route::prefix('sessions')
->controller(SessionController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . "sessions.php");

// related data
Route::prefix('related-data')
->controller(RelatedDataController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . "relatedData.php");

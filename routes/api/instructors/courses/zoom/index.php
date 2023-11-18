<?php

use App\Http\Controllers\Api\Instructors\Courses\Zoom\ExamsController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\ExercisesController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\GroupsController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\PrivatesController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\ReportsController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\StudentsController;
use App\Http\Controllers\Api\Instructors\Courses\Zoom\ZoomCoursesController;
use Illuminate\Support\Facades\Route;

// courses
Route::prefix('courses')
    ->controller(ZoomCoursesController::class)
    ->group(__DIR__ . '/courses.php');

//students
Route::prefix('students')
    ->controller(StudentsController::class)
    ->group(__DIR__ . '/students.php');

// groups
Route::prefix('groups')
    ->controller(GroupsController::class)
    ->group(__DIR__ . '/groups.php');

// privates
Route::prefix('privates')
    ->controller(PrivatesController::class)
    ->group(__DIR__ . '/privates.php');

// reports
Route::prefix('reports')
    ->controller(ReportsController::class)
    ->group(__DIR__ . '/reports.php');

// exercises
Route::prefix('exercises')
    ->controller(ExercisesController::class)
    ->group(__DIR__ . '/exercises.php');

// exams
Route::prefix('exams')
    ->controller(ExamsController::class)
    ->group(__DIR__ . '/exams.php');

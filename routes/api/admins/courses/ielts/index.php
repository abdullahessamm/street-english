<?php

use App\Http\Controllers\Api\Admins\Courses\IeltsCourses\IeltsCoursesCategoryController;
use Illuminate\Support\Facades\Route;

// categories
Route::apiResource('categories', IeltsCoursesCategoryController::class);
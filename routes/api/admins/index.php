<?php

use App\Http\Controllers\Api\AppConfigDataController;
use Illuminate\Support\Facades\Route;

// users routes
Route::prefix('/users')->group(__DIR__ . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'index.php');

// courses routes
Route::prefix('/courses')->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR . 'index.php');

// exams routes
Route::prefix('/exams')->group(__DIR__ . DIRECTORY_SEPARATOR . 'exams' . DIRECTORY_SEPARATOR . 'index.php');

// app config
Route::prefix('/app-config')
    ->controller(AppConfigDataController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'app-config' . DIRECTORY_SEPARATOR . 'index.php');
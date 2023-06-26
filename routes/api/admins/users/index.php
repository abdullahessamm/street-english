<?php

use App\Http\Controllers\Api\Admins\Users\AdminsController;
use App\Http\Controllers\Api\Admins\Users\InstructorsController;
use Illuminate\Support\Facades\Route;

// admins routes
Route::prefix('/admins')
->controller(AdminsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'admins.php');

// students routes
Route::prefix('/students')
->group(__DIR__ . DIRECTORY_SEPARATOR . 'students' . DIRECTORY_SEPARATOR . 'index.php');

// instructors routes
Route::prefix('/instructors')
->controller(InstructorsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'instructors.php');

<?php 

use Illuminate\Support\Facades\Route;

// users routes
Route::prefix('/users')->group(__DIR__ . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'index.php');

// courses routes
Route::prefix('/courses')->group(__DIR__ . DIRECTORY_SEPARATOR . 'courses' . DIRECTORY_SEPARATOR . 'index.php');
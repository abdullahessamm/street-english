<?php

use Illuminate\Support\Facades\Route;

// courses
Route::prefix('courses')->group(__DIR__ . '/courses/index.php');
// account
Route::prefix('account')->group(__DIR__ . '/account/index.php');
// media
Route::prefix('media')->group(__DIR__ . '/media/index.php');

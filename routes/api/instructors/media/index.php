<?php

use Illuminate\Support\Facades\Route;

// courses media
Route::prefix('courses')->group(__DIR__ . '/courses/index.php');

// account media
Route::prefix('account')->group(__DIR__ . '/account/index.php');

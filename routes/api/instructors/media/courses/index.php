<?php

use App\Http\Controllers\Api\Instructors\Media\Courses\ZoomMediaController;
use Illuminate\Support\Facades\Route;

// zoom media
Route::prefix('zoom')
    ->controller(ZoomMediaController::class)
    ->group(__DIR__ . '/zoom.php');

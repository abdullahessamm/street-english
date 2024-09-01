<?php

use App\Http\Controllers\Api\Courses\ZoomCoursesController;
use Illuminate\Support\Facades\Route;

Route::controller(ZoomCoursesController::class)
  ->group(function () {
    Route::get("/", "index");
    Route::get('/{id}', 'show')->where('id', '^[0-9]+$');
  });

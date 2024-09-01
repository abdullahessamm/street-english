<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/zoom")
  ->group(__DIR__ . DIRECTORY_SEPARATOR . "zoom.php");

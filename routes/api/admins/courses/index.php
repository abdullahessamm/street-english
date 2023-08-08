<?php

use Illuminate\Support\Facades\Route;

// recorded
Route::prefix('recorded')
->group(__DIR__ . DIRECTORY_SEPARATOR . 'recorded' . DIRECTORY_SEPARATOR . 'index.php');

// ielts
Route::prefix('ietls')
->group(__DIR__ . DIRECTORY_SEPARATOR . 'ielts' . DIRECTORY_SEPARATOR . 'index.php');

// zoom
Route::prefix('zoom')
->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoom' . DIRECTORY_SEPARATOR . 'index.php');

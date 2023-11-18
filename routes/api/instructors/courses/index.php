<?php

use Illuminate\Support\Facades\Route;

// zoom module
Route::prefix('zoom')
    ->group(__DIR__ . '/zoom/index.php');

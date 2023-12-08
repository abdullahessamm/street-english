<?php

use Illuminate\Support\Facades\Route;

Route::prefix('sessions')->group(function () {
    Route::get('', 'sessionReports');
    Route::get('{id}', 'downloadSessionReport')->where('id', '^[0-9]+$');
});

Route::prefix('levels')->group(function () {
    Route::get('', 'levelsReports');
    Route::get('{id}', 'downloadLevelReport')->where('id', '^[0-9]+$');
});

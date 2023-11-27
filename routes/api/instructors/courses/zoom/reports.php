<?php

use Illuminate\Support\Facades\Route;

Route::get('init', 'reportCreationInit');

Route::prefix('sessions')->group(function () {
    Route::post('', 'createSessionReport');
    Route::get('{id}', 'downloadSessionReport');
});

Route::prefix('levels')->group(function () {
    Route::post('', 'createLevelReport');
    Route::get('{id}', 'downloadLevelReport');
});

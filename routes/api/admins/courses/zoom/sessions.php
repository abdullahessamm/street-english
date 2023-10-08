<?php

use Illuminate\Support\Facades\Route;

Route::get('{id}', 'show')->where('id', '^[0-9]+$');
Route::patch('{id}', 'update')->where('id', '^[0-9]+$');
Route::delete('{id}', 'destroy')->where('id', '^[0-9]+$');

// materials
Route::prefix('materials')->group(function () {
    Route::post('', 'uploadMaterial');
    Route::get('{id}', 'downloadMaterial')->where('id', '^[0-9]+$');
    Route::delete('{id}', 'deleteMaterial')->where('id', '^[0-9]+$');
});

// yalla nzaker videos
Route::prefix('yalla-nzaker')->group(function () {
    Route::post('', 'uploadYallaNzakerVideo');
    Route::get('{id}', 'downloadYallaNzakerVideo')->where('id', '^[0-9]+$');
    Route::delete('{id}', 'deleteYallaNzakerVideo')->where('id', '^[0-9]+$');
});

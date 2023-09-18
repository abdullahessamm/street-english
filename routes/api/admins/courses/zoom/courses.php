<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'index');
Route::get('/{id}', 'show')->where('id', '^[0-9]+$');
Route::post('/', 'store');
Route::patch('/{id}', 'update')->where('id', '^[0-9]+$');
Route::delete('/{id}', 'destroy')->where('id', '^[0-9]+$');

Route::prefix('{id}/media/')
->where(['id' => '^[0-9]+$'])
->group(function () {
    Route::post('thumbnail', 'updateThumbnail');
    Route::post('intro-video', 'updateIntroVideo');
});

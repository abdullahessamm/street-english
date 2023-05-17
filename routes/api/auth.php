<?php

use Illuminate\Support\Facades\Route;


Route::post('/login', 'login')->name('apiLogin');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'user');
    Route::post('/logout', 'logout');
});
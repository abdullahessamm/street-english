<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index');
Route::post('', 'store');
Route::get('{id}', 'show')->where('id', '^[0-9]+$');
Route::patch('{id}', 'update')->where('id', '^[0-9]+$');
Route::delete('{id}', 'destroy')->where('id', '^[0-9]+$');
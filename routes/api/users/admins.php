<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'index');
Route::get('{id}', 'show')->whereNumber('id');
Route::put('/', 'create');
Route::patch('{id}', 'update')->whereNumber('id');
Route::delete('{id}', 'destroy')->whereNumber('id');

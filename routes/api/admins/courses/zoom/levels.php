<?php

use Illuminate\Support\Facades\Route;

Route::get('{id}', 'show')->where('id', '^[0-9]+$');
Route::patch('{id}', 'update')->where('id', '^[0-9]+$');

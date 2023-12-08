<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index');
Route::get('{id}', 'show')->where('id', '^[0-9]+$');

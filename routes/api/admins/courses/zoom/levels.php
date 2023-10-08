<?php

use Illuminate\Support\Facades\Route;

Route::patch('{id}', 'update')->where('id', '^[0-9]+$');

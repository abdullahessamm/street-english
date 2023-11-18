<?php

use Illuminate\Support\Facades\Route;

Route::get('{id}/init-correction', 'initCorrection')->where('id', '^[0-9]+$');
Route::patch('{id}/correct', 'correct')->where('id', '^[0-9]+$');

<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'getSolvedExercises');
Route::get('{id}', 'getSolvedExercise')->where('id', '^[0-9]+$');
Route::put('answer', 'answerExercise');

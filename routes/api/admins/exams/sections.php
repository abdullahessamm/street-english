<?php

use Illuminate\Support\Facades\Route;

Route::get('', 'index');
Route::post('', 'store');
Route::get('{id}', 'show')->where('id', '^[0-9]+$');
Route::get('{id}/media', 'downloadSectionHeaderMedia')->where('id', '^[0-9]+$');
Route::post('{id}', 'update')->where('id', '^[0-9]+$');
Route::patch('{id}/questions', 'updateQuestions')->where('id', '^[0-9]+$');
Route::delete('{id}', 'destroy')->where('id', '^[0-9]+$');
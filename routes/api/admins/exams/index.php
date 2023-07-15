<?php

use App\Http\Controllers\Api\Admins\Exams\ExamController;
use App\Http\Controllers\Api\Admins\Exams\ExamSectionController;
use Illuminate\Support\Facades\Route;

//exams
Route::prefix('')
    ->controller(ExamController::class)
    ->group(function () {
        Route::get('', 'index');
        Route::post('', 'store');
        Route::get('{id}', 'show')->where('id', '^[0-9]+$');
        Route::patch('{id}', 'update')->where('id', '^[0-9]+$');
        Route::delete('{id}', 'destroy')->where('id', '^[0-9]+$');
    });

// sections
Route::prefix('sections')
    ->controller(ExamSectionController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'sections.php');

<?php

use App\Http\Controllers\Auth\Instructors\LoginController;
use App\Http\Controllers\Web\AppController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest:web:instructor,instructor.home'])->group(function () {
    Route::view('/login', 'instructor.auth.login');
    Route::view('/work-with-us','web.pages.work-with-us')->name('work-with-us');
    Route::post('/ajax/work-with-us/submit', [AppController::class, 'submitWorkWithUs'])->name('ajax.work-with-us.submit');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('instructor.login');
    Route::get('/logout', 'logout')->name('instructor.logout');
});

Route::view('/{param?}', 'instructor.app')
    ->where('param', '.*')
    ->name('instructor.home')
    ->middleware('auth:web:instructor,instructor.login');

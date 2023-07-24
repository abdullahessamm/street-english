<?php

use App\Http\Controllers\Auth\RecordedStudent\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::view('/', 'recorded-users.app')->name('recordedStudent.home')->middleware('auth:web:recordedStudent,recordedStudent.login');

Route::middleware('guest:web:recordedStudent,recordedStudent.home')->group(function () {
    Route::view('/login', 'recorded-users.auth.login');
    Route::view('/register', 'recorded-users.auth.register');
    Route::post('/register', [App\Http\Controllers\Auth\RecordedStudent\RegisterController::class, 'register'])
        ->name('recordedStudent.register');
});

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('recordedStudent.login');
    Route::get('/logout', 'logout')->name('recordedStudent.logout');
    // login with google
    Route::prefix('/login-with-google')->group(function () {
        Route::get('/', 'loginWithGoogleRedirect')->name('recordedStudent.loginWithGoogle');
        Route::get('/callback', 'loginWithGoogleCallback');
    });
});

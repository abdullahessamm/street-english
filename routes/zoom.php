<?php

use App\Http\Controllers\Auth\ZoomStudent\LoginController;
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





Route::view('/login', 'zoom-users.auth.login')->middleware('guest:web:zoomStudent,zoomStudent.home');
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('zoomStudent.login');
    Route::post('/logout', 'logout')->name('zoomStudent.logout');
});

Route::view('/{params?}', 'zoom-users.app')
    ->where('param', '.*')
    ->name('zoomStudent.home')
    ->middleware('auth:web:zoomStudent,zoomStudent.login');

<?php

use App\Http\Controllers\Auth\IeltsStudent\LoginController;
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




Route::view('/', 'ielts-users.app')->name('ieltsStudent.home')->middleware('auth:web:ieltsStudent,ieltsStudent.login');

Route::view('/login', 'ielts-users.auth.login')->middleware('guest:web:ieltsStudent,ieltsStudent.home');
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('ieltsStudent.login');
    Route::get('/logout', 'logout')->name('ieltsStudent.logout');
});

<?php

use App\Http\Controllers\Auth\Admin\LoginController;
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




Route::view('/', 'admins.app')->name('admin.home')->middleware('auth:web:admins,admins.login');

Route::view('/login', 'admins.auth.login')->middleware('guest:web:admins,admin.home');
Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login')->name('admins.login');
    Route::get('/logout', 'logout')->name('admins.logout');
});

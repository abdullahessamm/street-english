<?php

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// authentication routes
Route::prefix('/auth')
    ->controller(LoginController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'auth.php');


Route::middleware('auth:sanctum')->group(function () {
    // admins dashboaed
    Route::prefix('/admin-dashboard')
        ->middleware('admin')
        ->group(__DIR__ . DIRECTORY_SEPARATOR . 'admins' . DIRECTORY_SEPARATOR . 'index.php');
    
    // recorded students dashboard
    Route::prefix('/recorded-student-dashboard')
        ->middleware('recordedStudent')
        ->group(__DIR__ . DIRECTORY_SEPARATOR . 'recorded-students' . DIRECTORY_SEPARATOR . 'index.php');

    // zoom students dashboard
    Route::prefix('/zoom-student-dashboard')
        ->middleware('zoomStudent')
        ->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoom-students' . DIRECTORY_SEPARATOR . 'index.php');

    // ielts students dashboard
    Route::prefix('/ielts-student-dashboard')
        ->middleware('ieltsStudent')
        ->group(__DIR__ . DIRECTORY_SEPARATOR . 'ielts-students' . DIRECTORY_SEPARATOR . 'index.php');
});

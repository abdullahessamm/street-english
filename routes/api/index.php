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
    // users routes
    Route::prefix('/users')
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'index.php');
});

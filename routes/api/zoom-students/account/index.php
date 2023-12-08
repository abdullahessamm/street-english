<?php

use App\Http\Controllers\Api\ZoomStudents\Account\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->controller(ProfileController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'profile.php');

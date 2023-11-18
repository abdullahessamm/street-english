<?php

use App\Http\Controllers\Api\Instructors\Account\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->controller(ProfileController::class)
    ->group(__DIR__ . '/profile.php');

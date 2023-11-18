<?php

use App\Http\Controllers\Api\Instructors\Media\Account\ProfileMediaController;
use Illuminate\Support\Facades\Route;

// profile
Route::prefix('profile')
    ->controller(ProfileMediaController::class)
    ->group(__DIR__ . '/profile.php');

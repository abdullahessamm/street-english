<?php

// profile
use App\Http\Controllers\Api\ZoomStudents\Media\Account\ProfileMediaController;
use Illuminate\Support\Facades\Route;

Route::prefix('profile')
    ->controller(ProfileMediaController::class)
    ->group(__DIR__ . DIRECTORY_SEPARATOR . 'profile.php');

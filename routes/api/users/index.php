<?php

use App\Http\Controllers\Api\Users\AdminsController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admins')
->controller(AdminsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'admins.php');
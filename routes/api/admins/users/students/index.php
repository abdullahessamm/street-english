<?php 

// recorded courses students routes

use App\Http\Controllers\Api\Admins\Users\Students\IELTSCourseStudentsController;
use App\Http\Controllers\Api\Admins\Users\Students\RecordedCourseStudentsController;
use Illuminate\Support\Facades\Route;

Route::prefix('recorded')
->controller(RecordedCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'recordedCourseStudents.php');

Route::prefix('ietls')
->controller(IELTSCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'ieltsCourseStudents.php');

Route::prefix('zoom')
->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoom' . DIRECTORY_SEPARATOR . 'index.php');

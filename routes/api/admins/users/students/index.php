<?php 

// recorded courses students routes

use App\Http\Controllers\Api\Admins\Users\Students\IELTSCourseStudentsController;
use App\Http\Controllers\Api\Admins\Users\Students\RecordedCourseStudentsController;
use App\Http\Controllers\Api\Admins\Users\Students\ZoomCourseStudentsController;
use Illuminate\Support\Facades\Route;

Route::prefix('recorded')
->controller(RecordedCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'recordedCourseStudents.php');

Route::prefix('ietls')
->controller(IELTSCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'ieltsCourseStudents.php');

Route::prefix('zoom')
->controller(ZoomCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoomCourseStudents.php');

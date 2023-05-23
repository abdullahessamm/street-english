<?php 

// recorded courses students routes

use App\Http\Controllers\Api\Users\Students\IELTSCourseStudentsController;
use App\Http\Controllers\Api\Users\Students\RecordedCourseStudentsController;
use App\Http\Controllers\Api\Users\Students\ZoomCourseStudentsController;
use Illuminate\Support\Facades\Route;

Route::prefix('recorded-courses')
->controller(RecordedCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'recordedCourseStudents.php');

Route::prefix('ielts-courses')
->controller(IELTSCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'ieltsCourseStudents.php');

Route::prefix('zoom-courses')
->controller(ZoomCourseStudentsController::class)
->group(__DIR__ . DIRECTORY_SEPARATOR . 'zoomCourseStudents.php');

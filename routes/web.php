<?php

use App\Http\Controllers\Web\AppController;
use App\Http\Controllers\Web\CertificateController;
use App\Http\Controllers\Web\Pages\Blogs\BlogController;
use App\Http\Controllers\Web\Pages\Bundles\BundleController;
use App\Http\Controllers\Web\Pages\Coaches\CoachController;
use App\Http\Controllers\Web\Pages\Courses\CourseController;
use App\Http\Controllers\Web\Pages\Courses\IETLSCourses\IETLSCourseController;
use App\Http\Controllers\Web\Pages\Courses\ZoomLiveCourses\ZoomLiveCourseController;
use App\Http\Controllers\Web\Pages\Ebooks\EbookController;
use App\Http\Controllers\Web\Pages\VerifyMailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [AppController::class, 'index'])->name('index');

Route::get('/about', [AppController::class, 'about'])->name('about');

/* Start Online Courses Pages */
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/course/{slug}', [CourseController::class, 'show'])->name('course.show');

/* End Online Courses Pages */


/* Start IETLS Courses Pages */
Route::get('/ietls-courses', [IETLSCourseController::class, 'index'])->name('ietls-courses');
Route::get('/ietls-course/{slug}', [IETLSCourseController::class, 'show'])->name('ietls-course.show');
/* End IETLS Courses Pages */


/* Start Zoom Live Pages */
Route::get('/zoom-live-courses', [ZoomLiveCourseController::class, 'index'])->name('zoom-live-courses');
Route::get('/zoom-live-course/{slug}', [ZoomLiveCourseController::class, 'show'])->name('zoom-live-course.show');
/* End Zoom Live Pages */

/* Start Bundles Pages */
Route::get('/bundles', [BundleController::class, 'index'])->name('bundles');
Route::get('/bundle/show/{slug}', [BundleController::class, 'show'])->name('bundle.show');

/* End Bundles Pages */

/* Start Bundles Pages */
Route::get('/free-ebooks', [EbookController::class, 'index'])->name('free-ebooks');
Route::get('/free-ebook/show/{slug}', [EbookController::class, 'show'])->name('free-ebook.show');
/* End Bundles Pages */

/* Start Blogs Pages */
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/post/{slug}', [[BlogController::class, 'show']])->name('post.show');
/* End Blogs Pages */

/* Start Coaches Pages */
Route::get('/coach-details/{id}', [CoachController::class, 'show'])->name('instructor.show');
/* End Coaches Pages */


/* Start Certificate Pages */
Route::get('/search/certificates', [CertificateController::class, 'index'])->name('certificates');
Route::get('/search/certificate/{slug}', [CertificateController::class, 'show'])->name('certificate.show');

Route::post('/ajax/search/certificate/', [CertificateController::class, 'search'])->name('ajax.certificate.search');
/* End Certificate Pages */


/* Start OtherPages */
Route::post('/ajax/subscribe', 'AppController@subscribe')->name('ajax.subscribe');
/* End Other Pages */

Route::get('/contact', [AppController::class, 'contact'])->name('contact');

Route::get('mail/verify/{token}', [VerifyMailController::class, 'verify'])
    ->where('token', '^[0-9]+$');

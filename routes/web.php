<?php

use App\Coach;
use App\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'AppController@index')->name('index');

Route::get('/about', 'AppController@about')->name('about');

/* Start Placement Test Pages */
Route::get('/placement-test', 'PlacementTestController@index')->name('placement-test');
Route::get('/placement-test/user/{slug}', 'PlacementTestController@show')->name('placement-test.show');
Route::post('/ajax/join/placement-test', 'PlacementTestController@joinPlacementTest')->name('ajax.join.placement-test');
Route::post('/ajax/placement-test/submit-answers', 'PlacementTestController@submitAnswers')->name('ajax.placement-test.submit-answers');
/* Start Placement Test Pages */

/* Start Online Courses Pages */
Route::get('/courses', 'Pages\Courses\CourseController@index')->name('courses');
Route::get('/course/{slug}', 'Pages\Courses\CourseController@show')->name('course.show');

Route::post('/ajax/course/preview-lesson', 'Pages\Courses\AjaxCourseController@previewLesson')->name('ajax.course.preview-lesson');
Route::post('/ajax/course/buy-course', 'Pages\Courses\AjaxCourseController@buyCourse')->name('ajax.course.buy-course');
Route::post('/ajax/course/login-to-buy-course', 'Pages\Courses\AjaxCourseController@loginToBuyCourse')->name('ajax.course.login-to-buy-course');
/* End Online Courses Pages */



/* Start IETLS Courses Pages */
Route::get('/ietls-courses', 'Pages\Courses\IETLSCourses\IETLSCourseController@index')->name('ietls-courses');
Route::get('/ietls-course/{slug}', 'Pages\Courses\IETLSCourses\IETLSCourseController@show')->name('ietls-course.show');

Route::post('/ajax/ietls-course/preview-lesson', 'Pages\Courses\IETLSCourses\AjaxIETLSCourseController@previewLesson')->name('ajax.ietls-course.preview-lesson');
Route::post('/ajax/ietls-course/buy-course', 'Pages\Courses\IETLSCourses\AjaxIETLSCourseController@buyCourse')->name('ajax.ietls-course.buy-ietls-course');
Route::post('/ajax/ietls-course/login-to-buy-course', 'Pages\Courses\IETLSCourses\AjaxIETLSCourseController@loginToBuyCourse')->name('ajax.ietls-course.login-to-buy-ietls-course');
/* End IETLS Courses Pages */





/* Start Zoom Live Pages */
Route::get('/zoom-live-courses', 'Pages\Courses\ZoomLiveCourses\ZoomLiveCourseController@index')->name('zoom-live-courses');
Route::get('/zoom-live-course/{slug}', 'Pages\Courses\ZoomLiveCourses\ZoomLiveCourseController@show')->name('zoom-live-course.show');
/* End Zoom Live Pages */

/* Start Training Courses Pages */
Route::get('/training-courses', 'Pages\Courses\TrainingCourses\TrainingCourseController@index')->name('training-courses');
Route::get('/training-course/{slug}', 'Pages\Courses\TrainingCourses\TrainingCourseController@show')->name('training-course.show');
Route::get('/training-course/confirmation/{slug}', 'Pages\Courses\TrainingCourses\TrainingCourseController@confirmation')->name('training-course.confirmation');

Route::post('/ajax/training-course/public-users/join', 'Pages\Courses\TrainingCourses\AjaxTrainingCourseController@joinEventForPublicUser')->name('ajax.training-course.public-users.join');
/* End Training Courses Pages */

/* Start Bundles Pages */
Route::get('/bundles', 'Pages\Bundles\BundleController@index')->name('bundles');
Route::get('/bundle/show/{slug}', 'Pages\Bundles\BundleController@show')->name('bundle.show');

// ajax call to buy bundle
Route::post('/ajax/course/buy-bundle', 'Pages\Bundles\BundleController@buyBundle')->name('ajax.course.buy-bundle');
/* End Bundles Pages */

/* Start Bundles Pages */
Route::get('/free-ebooks', 'Pages\Ebooks\EbookController@index')->name('free-ebooks');
Route::get('/free-ebook/show/{slug}', 'Pages\Ebooks\EbookController@show')->name('free-ebook.show');
/* End Bundles Pages */


/* Start TV Shows Pages */
Route::get('/tv-shows', 'Pages\TVShows\TVShowController@index')->name('tv-shows');
Route::get('/tv-show/{show_name}', 'Pages\TVShows\TVShowController@show')->name('tv-show.show_name');
Route::get('/tv-show/{show_name}/episode/{episode_name}', 'Pages\TVShows\TVShowController@episode')->name('tv-show.episode');
/* End TV Shows Pages */

/* Start Blogs Pages */
Route::get('/blogs', 'Pages\Blogs\BlogController@index')->name('blogs');
Route::get('/post/{slug}', 'Pages\Blogs\BlogController@show')->name('post.show');
/* End Blogs Pages */

/* Start Book a Session Pages */
Route::get('/book-a-session', 'Pages\Session\MySessions\MySessionController@index')->name('book-a-session');
Route::get('/book-a-session/confirmation/{slug}', 'Pages\Session\MySessions\MySessionController@confirmation')->name('book-a-session.confirmation');

Route::get('ajax/calendar', 'Pages\Session\MySessions\AjaxMySessionController@calendar')->name('calendar');
Route::post('ajax/calendar/appointments', 'Pages\Session\MySessions\AjaxMySessionController@calendarAppointments')->name('calendar.appointments');
Route::post('ajax/calendar/book/appointment', 'Pages\Session\MySessions\AjaxMySessionController@bookAppointment')->name('calendar.book.appointment');
/* End Book a Session Pages */

/* Start Coaches Pages */
Route::get('/coaches', 'Pages\Coaches\CoachController@index')->name('instructors');
Route::get('/coach-details/{id}', 'Pages\Coaches\CoachController@show')->name('instructor.show');
Route::get('/coach-details/{id}/book-a-session/confirmation/{slug}', 'Pages\Coaches\CoachController@confirmation')->name('instructor.book-a-session.confirmation');

Route::get('ajax/coach/{coach_id}/calendar', 'Pages\Coaches\AjaxCoachController@calendar')->name('instructor.calendar');
Route::post('ajax/coach/{coach_id}/calendar/appointments', 'Pages\Coaches\AjaxCoachController@calendarAppointments')->name('instructor.calendar.appointments');
Route::post('ajax/coach/{coach_id}/calendar/book/appointment', 'Pages\Coaches\AjaxCoachController@bookAppointment')->name('instructor.calendar.book.appointment');
/* End Coaches Pages */


/* Start Certificate Pages */
Route::get('/search/certificates', 'CertificateController@index')->name('certificates');
Route::get('/search/certificate/{slug}', 'CertificateController@show')->name('certificate.show');

Route::post('/ajax/search/certificate/', 'CertificateController@search')->name('ajax.certificate.search');
/* End Certificate Pages */


/* Start Preview Exam Pages */
Route::get('/preview/exam/{slug}', 'Pages\PreviewExamController@index')->name('preview.exam');
/* End Preview Exam Pages */


/* Start SurveyJs Exam Pages */
Route::get('/exam/{slug}/register', 'ExamController@index')->name('exam.register');
Route::get('/exam/user/{slug}/show', 'ExamController@show')->name('exam.user.show');
Route::get('/exam/user/{slug}/results', 'ExamController@results')->name('exam.user.results');

// ajax call to register for the exam
Route::post('/ajax/join/exam', 'ExamController@joinExam')->name('ajax.join.exam');
// ajax call to submit exam answers
Route::post('/ajax/exam/submit-answers', 'ExamController@submitAnswers')->name('ajax.exam.submit-answers');
/* Start SurveyJs Exam Pages */


/* Start OtherPages */
Route::get('/help', 'AppController@help')->name('help');
Route::get('/privacy', 'AppController@privacy')->name('privacy');
Route::get('/copyright', 'AppController@copyright')->name('copyright');
Route::get('/terms-and-condition', 'AppController@termsAndCondition')->name('terms-and-condition');
Route::get('/faq', 'AppController@faq')->name('faq');
Route::get('/work-with-us', 'AppController@workWithUs')->name('work-with-us');
Route::post('/ajax/work-with-us/submit', 'AppController@submitWorkWithUs')->name('ajax.work-with-us.submit');
Route::post('/ajax/subscribe', 'AppController@subscribe')->name('ajax.subscribe');
/* End Other Pages */


Route::get('/contact', 'AppController@contact')->name('contact');

Auth::routes();
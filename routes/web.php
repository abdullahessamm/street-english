<?php

use App\Admin;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pages\Blogs\AjaxBlogController;
use App\Http\Controllers\Pages\Blogs\BlogController;
use App\Http\Controllers\Pages\Blogs\Categories\AjaxCategoryController;
use App\Http\Controllers\Pages\Blogs\Categories\CategoryController;
use App\Http\Controllers\Pages\Bundles\AjaxBundleController;
use App\Http\Controllers\Pages\Bundles\BundleController;
use App\Http\Controllers\Pages\Certificates\PublicCertificates\AjaxPublicCertificate;
use App\Http\Controllers\Pages\Certificates\PublicCertificates\PublicCertificate;
use App\Http\Controllers\Pages\CoachingMemberships\CoachingMembershipController;
use App\Http\Controllers\Pages\CoachingMemberships\AjaxCoachingMembershipController;
use App\Http\Controllers\Pages\Courses\AjaxCourseController;
use App\Http\Controllers\Pages\Courses\Categories\AjaxCourseCategoryController;
use App\Http\Controllers\Pages\Courses\Categories\CourseCategoryController;
use App\Http\Controllers\Pages\Courses\CourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForCourses\AjaxEnrolledStudentsForCourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForCourses\EnrolledStudentsForCourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForIETLSCourses\AjaxEnrolledStudentsForIETLSCourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForIETLSCourses\EnrolledStudentsForIETLSCourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForZoomCourses\AjaxEnrolledStudentsForZoomCourseController;
use App\Http\Controllers\Pages\EnrolledStudentsForZoomCourses\EnrolledStudentsForZoomCourseController;
use App\Http\Controllers\Pages\Exams\ExamController;
use App\Http\Controllers\Pages\Exams\RegistedUsersExam\AjaxRegistedUserExamController;
use App\Http\Controllers\Pages\Exams\RegistedUsersExam\RegistedUserExamController;
use App\Http\Controllers\Pages\Exercise\ExerciseController;
use App\Http\Controllers\Pages\IETLSCourses\AjaxIETLSCoursesController;
use App\Http\Controllers\Pages\IETLSCourses\Categories\AjaxIETLSCoursesCategoryController;
use App\Http\Controllers\Pages\IETLSCourses\Categories\IETLSCourseCategoryController;
use App\Http\Controllers\Pages\IETLSCourses\IETLSCourseController;
use App\Http\Controllers\Pages\IETLSCourses\IETLSCoursesUsers\AjaxIETLSCourseUserController;
use App\Http\Controllers\Pages\IETLSCourses\IETLSCoursesUsers\IETLSCourseUserController;
use App\Http\Controllers\Pages\InstructorsForCourses\AjaxInstructorsForCourseController;
use App\Http\Controllers\Pages\InstructorsForCourses\InstructorsForCourseController;
use App\Http\Controllers\Pages\Library\AjaxLibraryController;
use App\Http\Controllers\Pages\Library\LibraryController;
use App\Http\Controllers\Pages\PopularCourses\AjaxPopularCourseController;
use App\Http\Controllers\Pages\PopularCourses\PopularCourseController;
use App\Http\Controllers\Pages\Students\StudentController;
use App\Http\Controllers\Pages\Students\AjaxStudentController;
use App\Http\Controllers\Pages\Survey\SurveyController;
use App\Http\Controllers\Pages\ZoomCourses\AjaxZoomCourseController;
use App\Http\Controllers\Pages\ZoomCourses\ZoomCourseController;
use App\Http\Controllers\Pages\ZoomCourses\ZoomCoursesUsers\AjaxZoomCourseUserController;
use App\Http\Controllers\Pages\ZoomCourses\ZoomCoursesUsers\ZoomCourseUserController;
use App\Http\Controllers\Settings\SettingsController;
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




Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');


/* Start Students Pages */
// Student Views
Route::get('/students', [StudentController::class, 'index'])->name('students');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::get('/student/show/{slug}', [StudentController::class, 'show'])->name('student.show');

// ajax call to view view list of all students
Route::get('/ajax/students/index', [AjaxStudentController::class, 'index'])->name('ajax.students.index');
// ajax call to create new student
Route::post('/ajax/student/create', [AjaxStudentController::class, 'create'])->name('ajax.student.create');
// ajax call to create update existing student
Route::post('/ajax/student/update', [AjaxStudentController::class, 'update'])->name('ajax.student.update');
// ajax call to delete student
Route::post('/ajax/student/delete', [AjaxStudentController::class, 'delete'])->name('ajax.student.delete');
/* Start Students Pages */



/* Start Coaches Pages */
// Coach Views
Route::get('/coach/categories', [App\Http\Controllers\Pages\Coaches\CoachCategoryController::class, 'index'])->name('coach.categories');
Route::get('/coaches', [App\Http\Controllers\Pages\Coaches\CoachController::class, 'index'])->name('coaches');
Route::get('/coach/create', [App\Http\Controllers\Pages\Coaches\CoachController::class, 'create'])->name('coach.create');
Route::get('/coach/show/{slug}', [App\Http\Controllers\Pages\Coaches\CoachController::class, 'show'])->name('coach.show');

// ajax call to view 
Route::get('/ajax/coach/categories', [App\Http\Controllers\Pages\Coaches\AjaxCoachCategoryController::class, 'index'])->name('coach.coach.categories');
// ajax call to create new coach category
Route::post('/ajax/coach/category/create', [App\Http\Controllers\Pages\Coaches\AjaxCoachCategoryController::class, 'create'])->name('coach.coach.category.create');
// ajax call to view view list of all coaches
Route::get('/ajax/coaches/index', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'index'])->name('ajax.coaches.index');
// ajax call to create new coach
Route::post('/ajax/coach/create', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'create'])->name('ajax.coach.create');
// ajax call to update coach info
Route::post('/ajax/coach/update/coach/info', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'updateInfo'])->name('ajax.coach.update.coach.info');
// ajax call to update coach social media links
Route::post('/ajax/coach/update/coach/social-media', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'updateSocialMedia'])->name('ajax.coach.update.coach.social-media');
// ajax call to update coach image
Route::post('/ajax/coach/update/coach/image', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'updateImage'])->name('ajax.coach.update.coach.image');
// ajax call to delete coach
Route::post('/ajax/coach/delete', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'delete'])->name('ajax.coach.delete');
// ajax call to make permission to make session for coach
Route::post('/ajax/coach/permission-to-make-sessions', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'permissionToMakeSessions'])->name('ajax.coach.permission-to-make-sessions');
// ajax call to make permission to publish course for coach
Route::post('/ajax/coach/permission-to-publish-courses', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'permissionToPublishCourses'])->name('ajax.coach.permission-to-publish-courses');
// ajax call to make permission to publish blogs for coach
Route::post('/ajax/coach/permission-to-publish-blogs', [App\Http\Controllers\Pages\Coaches\AjaxCoachController::class, 'permissionToPublishBlogs'])->name('ajax.coach.permission-to-publish-blogs');
/* End Coaches Pages */



/* Start Coaching Membership Pages */
Route::get('/coaching-memberships', [CoachingMembershipController::class, 'index'])->name('coaching-memberships');
Route::get('/coaching-membership/show/{slug}', [CoachingMembershipController::class, 'show'])->name('coaching-membership.show');

// ajax call to view view list of all coaches
Route::get('/ajax/coaching-memberships/index', [AjaxCoachingMembershipController::class, 'index'])->name('ajax.coaching-memberships.index');
/* End Coaching Membership Pages */




/* Start Courses Pages */
// Course Views
Route::get('/courses/categories', [CourseCategoryController::class, 'index'])->name('courses-categories');
Route::get('/courses', [CourseController::class, 'index'])->name('courses');
Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
Route::get('/course/show/{slug}', [CourseController::class, 'show'])->name('course.show');
Route::get('/course/show/{slug}/contents', [CourseController::class, 'contents'])->name('course.contents');
Route::get('/course/show/{slug}/content/{content_slug}/lesson/{lesson_slug}', [CourseController::class, 'lesson'])->name('course.content.lesson');

// ajax call to view view list of all courses categpry
Route::get('/ajax/courses-category/index', [AjaxCourseCategoryController::class, 'index'])->name('ajax.courses-category.index');
// ajax call to create new course categpry
Route::post('/ajax/course-category/create', [AjaxCourseCategoryController::class, 'create'])->name('ajax.course-category.create');
// ajax call to update course categpry
Route::post('/ajax/course-category/update', [AjaxCourseCategoryController::class, 'update'])->name('ajax.course-category.update');
// ajax call to delete course categpry
Route::post('/ajax/course-category/delete', [AjaxCourseCategoryController::class, 'delete'])->name('ajax.course-category.delete');
// ajax call to view view list of all courses
Route::get('/ajax/courses/index', [AjaxCourseController::class, 'index'])->name('ajax.courses.index');
// ajax call to preview media type
Route::post('/ajax/course/preview/media-intro-type', [AjaxCourseController::class, 'previewMediaType'])->name('ajax.courses.preview.media-intro-type');
// ajax call to preview price options
Route::post('/ajax/course/preview/price-option', [AjaxCourseController::class, 'previewPriceOption'])->name('ajax.courses.preview.price-option');
// ajax call to create new course
Route::post('/ajax/course/create', [AjaxCourseController::class, 'create'])->name('ajax.course.create');
// ajax call to create update existing course
Route::post('/ajax/course/update', [AjaxCourseController::class, 'update'])->name('ajax.course.update');
// ajax call to publish course
Route::post('/ajax/course/publish', [AjaxCourseController::class, 'publish'])->name('ajax.course.publish');
// ajax call to un-publish course
Route::post('/ajax/course/un-publish', [AjaxCourseController::class, 'unPublish'])->name('ajax.course.un-publish');
// ajax call to delete course
Route::post('/ajax/course/delete', [AjaxCourseController::class, 'delete'])->name('ajax.course.delete');
// ajax call to create update existing course
Route::post('/ajax/course/ajax.course.add-or-remove-instructor', [AjaxCourseController::class, 'addOrRemoveInstructor'])->name('ajax.course.add-or-remove-instructor');
// ajax call to delete course
Route::post('/ajax/course/delete', [AjaxCourseController::class, 'delete'])->name('ajax.course.delete');
// ajax call to create new content
Route::post('/ajax/course/content/create', [AjaxCourseController::class, 'createContent'])->name('ajax.course.content.create');
// ajax call to update content title
Route::post('/ajax/course/content/title/update', [AjaxCourseController::class, 'updateContentTitle'])->name('ajax.course.content.title.update');
// ajax call to update content description
Route::post('/ajax/course/content/description/update', [AjaxCourseController::class, 'updateContentDescription'])->name('ajax.course.content.description.update');
// ajax call to delete content
Route::post('/ajax/course/content/delete', [AjaxCourseController::class, 'deleteContent'])->name('ajax.course.content.delete');
// ajax call to create new lesson
Route::post('/ajax/course/content/lesson/create', [AjaxCourseController::class, 'createLesson'])->name('ajax.course.content.lesson.create');
// ajax call to delete lesson
Route::post('/ajax/course/content/lesson/delete', [AjaxCourseController::class, 'deleteLesson'])->name('ajax.course.content.lesson.delete');
// ajax call to create lesson type
Route::post('/ajax/course/content/lesson/type/create', [AjaxCourseController::class, 'createLessonType'])->name('ajax.course.content.lesson.type.create');
// ajax call to check if lesson is locked
Route::post('/ajax/course/content/lesson/is-locked', [AjaxCourseController::class, 'isLocked'])->name('ajax.course.content.lesson.is-locked');
// ajax call to check if lesson is continueable
Route::post('/ajax/course/content/lesson/is-continueable', [AjaxCourseController::class, 'isContinueable'])->name('ajax.course.content.lesson.is-continueable');
// ajax call to check if lesson is achievable
Route::post('/ajax/course/content/lesson/is-achievable', [AjaxCourseController::class, 'isAchievable'])->name('ajax.course.content.lesson.is-achievable');
// ajax call to add points to lesson
Route::post('/ajax/course/content/lesson/add-points', [AjaxCourseController::class, 'addPoints'])->name('ajax.course.content.lesson.add-points');
// ajax call to update lesson description
Route::post('/ajax/course/content/lesson/description/update', [AjaxCourseController::class, 'updateLessonDescription'])->name('ajax.course.content.lesson.description.update');
// ajax call to choose instructor for a lesson
Route::post('/ajax/course/content/lesson/instructor', [AjaxCourseController::class, 'chooseInstructor'])->name('ajax.course.content.lesson.instructor');
// ajax call to check if lesson is published
Route::post('/ajax/course/content/lesson/is-published', [AjaxCourseController::class, 'isLessonPublished'])->name('ajax.course.content.lesson.is-published');
// ajax call to upload video lesson
Route::post('/ajax/course/content/lesson/video/upload', [AjaxCourseController::class, 'uploadVideoLesson'])->name('ajax.course.content.lesson.video.upload');
// ajax call to update video lesson
Route::post('/ajax/course/content/lesson/video/update', [AjaxCourseController::class, 'updateVideoLesson'])->name('ajax.course.content.lesson.video.update');
// ajax call to check if video lesson is downloadable or not
Route::post('/ajax/course/content/lesson/video/is-downloadble', [AjaxCourseController::class, 'isVideoLessonDownloadable'])->name('ajax.course.content.lesson.video.is-downloadable');
// ajax call to upload audio lesson
Route::post('/ajax/course/content/lesson/audio/upload', [AjaxCourseController::class, 'uploadAudioLesson'])->name('ajax.course.content.lesson.audio.upload');
// ajax call to update audio lesson
Route::post('/ajax/course/content/lesson/audio/update', [AjaxCourseController::class, 'updateAudioLesson'])->name('ajax.course.content.lesson.audio.update');
// ajax call to check if audio lesson is downloadable or not
Route::post('/ajax/course/content/lesson/audio/is-downloadble', [AjaxCourseController::class, 'isAudioLessonDownloadable'])->name('ajax.course.content.lesson.audio.is-downloadable');
// ajax call to upload audio lesson
Route::post('/ajax/course/content/lesson/doc/upload', [AjaxCourseController::class, 'uploadDocLesson'])->name('ajax.course.content.lesson.doc.upload');
// ajax call to check if doc lesson is downloadable or not
Route::post('/ajax/course/content/lesson/doc/is-downloadble', [AjaxCourseController::class, 'isDocLessonDownloadable'])->name('ajax.course.content.lesson.doc.is-downloadable');
// ajax call to update lesson doc
Route::post('/ajax/course/content/lesson/doc/update', [AjaxCourseController::class, 'updateDocLesson'])->name('ajax.course.content.lesson.doc.update');
// ajax call to update lesson doc pages
Route::post('/ajax/course/content/lesson/doc/pages/update', [AjaxCourseController::class, 'updateDocPagesLesson'])->name('ajax.course.content.lesson.doc.pages.update');
// ajax call to create lesson context
Route::post('/ajax/course/content/lesson/context/create', [AjaxCourseController::class, 'createLessonContext'])->name('ajax.course.content.lesson.context.create');
// ajax call to update lesson context
Route::post('/ajax/course/content/lesson/context/update', [AjaxCourseController::class, 'updateLessonContext'])->name('ajax.course.content.lesson.context.update');
// ajax call to create lesson iframe
Route::post('/ajax/course/content/lesson/iframe/create', [AjaxCourseController::class, 'createLessonFrame'])->name('ajax.course.content.lesson.iframe.create');
// ajax call to update lesson iframe
Route::post('/ajax/course/content/lesson/iframe/update', [AjaxCourseController::class, 'updateLessonFrame'])->name('ajax.course.content.lesson.iframe.update');
// ajax call to create lesson exercise
Route::post('/ajax/course/content/lesson/exercise/create', [AjaxCourseController::class, 'createLessonExercise'])->name('ajax.course.content.lesson.exercise.create');
// ajax call to update lesson exercise
Route::post('/ajax/course/content/lesson/exercise/update', [AjaxCourseController::class, 'updateLessonExercise'])->name('ajax.course.content.lesson.exercise.update');
/* End Courses Pages */


/* Start Instructor's Course Pages */
Route::get('/instructors-for-courses', [InstructorsForCourseController::class, 'index'])->name('instructors-for-courses');
Route::get('/instructors-for-course/{course_name}', [InstructorsForCourseController::class, 'show'])->name('instructors-for-course.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/instructors-for-course/index', [AjaxInstructorsForCourseController::class, 'index'])->name('ajax.instructors-for-course.index');
// ajax call to append new student(s)
Route::post('/ajax/instructors-for-course/append/instructor', [AjaxInstructorsForCourseController::class, 'append'])->name('ajax.instructors-for-course.append.instructor');
// ajax call to suspend instructor
Route::post('/ajax/instructors-for-course/student/suspend', [AjaxInstructorsForCourseController::class, 'suspend'])->name('ajax.instructors-for-course.student.suspend');
// ajax call to un-suspend instructor
Route::post('/ajax/instructors-for-course/student/un-suspend', [AjaxInstructorsForCourseController::class, 'unSuspend'])->name('ajax.instructors-for-course.student.un-suspend');
// ajax call to remove instructor from course
Route::post('/ajax/instructors-for-course/instructor/remove', [AjaxInstructorsForCourseController::class, 'remove'])->name('ajax.instructors-for-course.instructor.remove');
/* Start Instructor's Course Pages */



/* Start Apppend User to Course Pages */
Route::get('/enrolled-students-for-courses', [EnrolledStudentsForCourseController::class, 'index'])->name('enrolled-students-for-courses');
Route::get('/enrolled-students-for-courses/{course_name}', [EnrolledStudentsForCourseController::class, 'show'])->name('enrolled-students-for-courses.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/enrolled-students-for-courses/index', [AjaxEnrolledStudentsForCourseController::class, 'index'])->name('ajax.enrolled-students-for-courses.index');
// ajax call to append new student(s)
Route::post('/ajax/enrolled-students-for-courses/append/student', [AjaxEnrolledStudentsForCourseController::class, 'append'])->name('ajax.enrolled-students-for-courses.append.student');
// ajax call to suspend student
Route::post('/ajax/enrolled-students-for-courses/student/suspend', [AjaxEnrolledStudentsForCourseController::class, 'suspend'])->name('ajax.enrolled-students-for-courses.student.suspend');
// ajax call to un-suspend student
Route::post('/ajax/enrolled-students-for-courses/student/un-suspend', [AjaxEnrolledStudentsForCourseController::class, 'unSuspend'])->name('ajax.enrolled-students-for-courses.student.un-suspend');
// ajax call to remove student from course
Route::post('/ajax/enrolled-students-for-courses/student/remove', [AjaxEnrolledStudentsForCourseController::class, 'remove'])->name('ajax.enrolled-students-for-courses.student.remove');
/* End Apppend User to Course Pages */



/* Start Popular Online Course Pages */
Route::get('/popular-courses', [PopularCourseController::class, 'index'])->name('popular-courses');

// ajax call to view list of all popular courses
Route::get('/ajax/popular-courses/index', [AjaxPopularCourseController::class, 'index'])->name('ajax.popular-courses.index');
// ajax call to add popular course
Route::post('/ajax/popular-course/add', [AjaxPopularCourseController::class, 'addPopularCourse'])->name('ajax.popular-course.add');
// ajax call to remove student from course
Route::post('/ajax/popular-course/remove', [AjaxPopularCourseController::class, 'remove'])->name('ajax.popular-course.remove');
/* End Popular Online Course Pages */



/* Start IETLS Courses Pages */
// ietls course Views
Route::get('/ietls-courses/categories', [IETLSCourseCategoryController::class, 'index'])->name('ietls-courses-categories');
Route::get('/ietls-courses', [IETLSCourseController::class, 'index'])->name('ietls-courses');
Route::get('/ietls-course/create', [IETLSCourseController::class, 'create'])->name('ietls-course.create');
Route::get('/ietls-course/show/{slug}', [IETLSCourseController::class, 'show'])->name('ietls-course.show');
Route::get('/ietls-course/show/{slug}/contents', [IETLSCourseController::class, 'contents'])->name('ietls-course.contents');
Route::get('/ietls-course/show/{slug}/content/{content_slug}/lesson/{lesson_slug}', [IETLSCourseController::class, 'lesson'])->name('ietls-course.content.lesson');

// ajax call to view view list of all ietls courses categpry
Route::get('/ajax/ietls-courses-category/index', [AjaxIETLSCoursesCategoryController::class, 'index'])->name('ajax.ietls-courses-category.index');
// ajax call to create new ietls course categpry
Route::post('/ajax/ietls-course-category/create', [AjaxIETLSCoursesCategoryController::class, 'create'])->name('ajax.ietls-course-category.create');
// ajax call to update ietls course categpry
Route::post('/ajax/ietls-course-category/update', [AjaxIETLSCoursesCategoryController::class, 'update'])->name('ajax.ietls-course-category.update');
// ajax call to delete ietls course categpry
Route::post('/ajax/ietls-course-category/delete', [AjaxIETLSCoursesCategoryController::class, 'delete'])->name('ajax.ietls-course-category.delete');
// ajax call to view view list of all ietls courses
Route::get('/ajax/ietls-courses/index', [AjaxIETLSCoursesController::class, 'index'])->name('ajax.ietls-courses.index');
// ajax call to preview media type
Route::post('/ajax/ietls-course/preview/media-intro-type', [AjaxIETLSCoursesController::class, 'previewMediaType'])->name('ajax.ietls-courses.preview.media-intro-type');
// ajax call to create new ietls course
Route::post('/ajax/ietls-course/create', [AjaxIETLSCoursesController::class, 'create'])->name('ajax.ietls-course.create');
// ajax call to create update existing ietls course
Route::post('/ajax/ietls-course/update', [AjaxIETLSCoursesController::class, 'update'])->name('ajax.ietls-course.update');
// ajax call to publish ietls course
Route::post('/ajax/ietls-course/publish', [AjaxIETLSCoursesController::class, 'publish'])->name('ajax.ietls-course.publish');
// ajax call to un-publish ietls course
Route::post('/ajax/ietls-course/un-publish', [AjaxIETLSCoursesController::class, 'unPublish'])->name('ajax.ietls-course.un-publish');
// ajax call to delete ietls course
Route::post('/ajax/ietls-course/delete', [AjaxIETLSCoursesController::class, 'delete'])->name('ajax.ietls-course.delete');
// ajax call to create update existing ietls course
Route::post('/ajax/ietls-course/ajax.course.add-or-remove-instructor', [AjaxIETLSCoursesController::class, 'addOrRemoveInstructor'])->name('ajax.ietls-course.add-or-remove-instructor');
// ajax call to delete ietls course
Route::post('/ajax/ietls-course/delete', [AjaxIETLSCoursesController::class, 'delete'])->name('ajax.ietls-course.delete');
// ajax call to create new content
Route::post('/ajax/ietls-course/content/create', [AjaxIETLSCoursesController::class, 'createContent'])->name('ajax.ietls-course.content.create');
// ajax call to update content title
Route::post('/ajax/ietls-course/content/title/update', [AjaxIETLSCoursesController::class, 'updateContentTitle'])->name('ajax.ietls-course.content.title.update');
// ajax call to update content description
Route::post('/ajax/ietls-course/content/description/update', [AjaxIETLSCoursesController::class, 'updateContentDescription'])->name('ajax.ietls-course.content.description.update');
// ajax call to delete content
Route::post('/ajax/ietls-course/content/delete', [AjaxIETLSCoursesController::class, 'deleteContent'])->name('ajax.ietls-course.content.delete');
// ajax call to create new lesson
Route::post('/ajax/ietls-course/content/lesson/create', [AjaxIETLSCoursesController::class, 'createLesson'])->name('ajax.ietls-course.content.lesson.create');
// ajax call to delete lesson
Route::post('/ajax/ietls-course/content/lesson/delete', [AjaxIETLSCoursesController::class, 'deleteLesson'])->name('ajax.ietls-course.content.lesson.delete');
// ajax call to create lesson type
Route::post('/ajax/ietls-course/content/lesson/type/create', [AjaxIETLSCoursesController::class, 'createLessonType'])->name('ajax.ietls-course.content.lesson.type.create');
// ajax call to check if lesson is locked
Route::post('/ajax/ietls-course/content/lesson/is-locked', [AjaxIETLSCoursesController::class, 'isLocked'])->name('ajax.ietls-course.content.lesson.is-locked');
// ajax call to check if lesson is continueable
Route::post('/ajax/ietls-course/content/lesson/is-continueable', [AjaxIETLSCoursesController::class, 'isContinueable'])->name('ajax.ietls-course.content.lesson.is-continueable');
// ajax call to check if lesson is achievable
Route::post('/ajax/ietls-course/content/lesson/is-achievable', [AjaxIETLSCoursesController::class, 'isAchievable'])->name('ajax.ietls-course.content.lesson.is-achievable');
// ajax call to add points to lesson
Route::post('/ajax/ietls-course/content/lesson/add-points', [AjaxIETLSCoursesController::class, 'addPoints'])->name('ajax.ietls-course.content.lesson.add-points');
// ajax call to update lesson description
Route::post('/ajax/ietls-course/content/lesson/description/update', [AjaxIETLSCoursesController::class, 'updateLessonDescription'])->name('ajax.ietls-course.content.lesson.description.update');
// ajax call to choose instructor for a lesson
Route::post('/ajax/ietls-course/content/lesson/instructor', [AjaxIETLSCoursesController::class, 'chooseInstructor'])->name('ajax.ietls-course.content.lesson.instructor');
// ajax call to check if lesson is published
Route::post('/ajax/ietls-course/content/lesson/is-published', [AjaxIETLSCoursesController::class, 'isLessonPublished'])->name('ajax.ietls-course.content.lesson.is-published');
// ajax call to upload video lesson
Route::post('/ajax/ietls-course/content/lesson/video/upload', [AjaxIETLSCoursesController::class, 'uploadVideoLesson'])->name('ajax.ietls-course.content.lesson.video.upload');
// ajax call to update video lesson
Route::post('/ajax/ietls-course/content/lesson/video/update', [AjaxIETLSCoursesController::class, 'updateVideoLesson'])->name('ajax.ietls-course.content.lesson.video.update');
// ajax call to check if video lesson is downloadable or not
Route::post('/ajax/ietls-course/content/lesson/video/is-downloadble', [AjaxIETLSCoursesController::class, 'isVideoLessonDownloadable'])->name('ajax.ietls-course.content.lesson.video.is-downloadable');
// ajax call to upload audio lesson
Route::post('/ajax/ietls-course/content/lesson/audio/upload', [AjaxIETLSCoursesController::class, 'uploadAudioLesson'])->name('ajax.ietls-course.content.lesson.audio.upload');
// ajax call to update audio lesson
Route::post('/ajax/ietls-course/content/lesson/audio/update', [AjaxIETLSCoursesController::class, 'updateAudioLesson'])->name('ajax.ietls-course.content.lesson.audio.update');
// ajax call to check if audio lesson is downloadable or not
Route::post('/ajax/ietls-course/content/lesson/audio/is-downloadble', [AjaxIETLSCoursesController::class, 'isAudioLessonDownloadable'])->name('ajax.ietls-course.content.lesson.audio.is-downloadable');
// ajax call to upload audio lesson
Route::post('/ajax/ietls-course/content/lesson/doc/upload', [AjaxIETLSCoursesController::class, 'uploadDocLesson'])->name('ajax.ietls-course.content.lesson.doc.upload');
// ajax call to check if doc lesson is downloadable or not
Route::post('/ajax/ietls-course/content/lesson/doc/is-downloadble', [AjaxIETLSCoursesController::class, 'isDocLessonDownloadable'])->name('ajax.ietls-course.content.lesson.doc.is-downloadable');
// ajax call to update lesson doc
Route::post('/ajax/ietls-course/content/lesson/doc/update', [AjaxIETLSCoursesController::class, 'updateDocLesson'])->name('ajax.ietls-course.content.lesson.doc.update');
// ajax call to update lesson doc pages
Route::post('/ajax/ietls-course/content/lesson/doc/pages/update', [AjaxIETLSCoursesController::class, 'updateDocPagesLesson'])->name('ajax.ietls-course.content.lesson.doc.pages.update');
// ajax call to create lesson context
Route::post('/ajax/ietls-course/content/lesson/context/create', [AjaxIETLSCoursesController::class, 'createLessonContext'])->name('ajax.ietls-course.content.lesson.context.create');
// ajax call to update lesson context
Route::post('/ajax/ietls-course/content/lesson/context/update', [AjaxIETLSCoursesController::class, 'updateLessonContext'])->name('ajax.ietls-course.content.lesson.context.update');
// ajax call to create lesson iframe
Route::post('/ajax/ietls-course/content/lesson/iframe/create', [AjaxIETLSCoursesController::class, 'createLessonFrame'])->name('ajax.ietls-course.content.lesson.iframe.create');
// ajax call to update lesson iframe
Route::post('/ajax/ietls-course/content/lesson/iframe/update', [AjaxIETLSCoursesController::class, 'updateLessonFrame'])->name('ajax.ietls-course.content.lesson.iframe.update');
// ajax call to create lesson exercise
Route::post('/ajax/ietls-course/content/lesson/exercise/create', [AjaxIETLSCoursesController::class, 'createLessonExercise'])->name('ajax.ietls-course.content.lesson.exercise.create');
// ajax call to update lesson exercise
Route::post('/ajax/ietls-course/content/lesson/exercise/update', [AjaxIETLSCoursesController::class, 'updateLessonExercise'])->name('ajax.ietls-course.content.lesson.exercise.update');
/* End IETLS Courses Pages */



/* Start Instructor's Online Course Pages */
Route::get('/instructors-for-ietls-courses', [App\Http\Controllers\Pages\InstructorsForIETLSCourses\IETLS::class, 'index'])->name('instructors-for-ietls-courses');
Route::get('/instructors-for-ietls-course/{course_name}', [Pages\InstructorsForIETLSCourses\IETLS::class, 'show'])->name('instructors-for-ietls-course.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/instructors-for-ietls-course/index', [Pages\InstructorsForIETLSCourses\IETLSAjaxInstructorsForCourseController::class, 'index'])->name('ajax.instructors-for-ietls-course.index');
// ajax call to append new student(s)
Route::post('/ajax/instructors-for-ietls-course/append/instructor', [Pages\InstructorsForIETLSCourses\IETLSAjaxInstructorsForCourseController::class, 'append'])->name('ajax.instructors-for-ietls-course.append.instructor');
// ajax call to suspend instructor
Route::post('/ajax/instructors-for-ietls-course/student/suspend', [Pages\InstructorsForIETLSCourses\IETLSAjaxInstructorsForCourseController::class, 'suspend'])->name('ajax.instructors-for-ietls-course.student.suspend');
// ajax call to un-suspend instructor
Route::post('/ajax/instructors-for-ietls-course/student/un-suspend', [Pages\InstructorsForIETLSCourses\IETLSAjaxInstructorsForCourseController::class, 'unSuspend'])->name('ajax.instructors-for-ietls-course.student.un-suspend');
// ajax call to remove instructor from course
Route::post('/ajax/instructors-for-ietls-course/instructor/remove', [Pages\InstructorsForIETLSCourses\IETLSAjaxInstructorsForCourseController::class, 'remove'])->name('ajax.instructors-for-ietls-course.instructor.remove');
/* End Instructor's Course Pages */


/* Start IETLS User Pages */
Route::get('/ietls-course/users', [IETLSCourseUserController::class, 'index'])->name('ietls-course.users');
Route::get('/ietls-course/user/create', [IETLSCourseUserController::class, 'create'])->name('ietls-course.user.create');
Route::get('/ietls-course/user/show/{slug}', [IETLSCourseUserController::class, 'show'])->name('ietls-course.user.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/ietls-course/users/index', [AjaxIETLSCourseUserController::class, 'index'])->name('ajax.ietls-course.users.index');
// ajax call to create new zoom course user
Route::post('/ajax/ietls-course/user/create', [AjaxIETLSCourseUserController::class, 'create'])->name('ajax.ietls-course.user.create');
// ajax call to update zoom course user info
Route::post('/ajax/ietls-course/user/update-info', [AjaxIETLSCourseUserController::class, 'updateInfo'])->name('ajax.ietls-course.user.update-info');
// ajax call to update zoom course user image
Route::post('/ajax/ietls-course/user/update-image', [AjaxIETLSCourseUserController::class, 'updateImage'])->name('ajax.ietls-course.user.update-image');
// ajax call to update zoom course delete user
Route::post('/ajax/ietls-course/user/delete', [AjaxIETLSCourseUserController::class, 'delete'])->name('ajax.ietls-course.user.delete');
/* End IETLS User Pages */


/* Start Apppend User to IETLS Course Pages */
Route::get('/enrolled-students-for-ietls-courses', [EnrolledStudentsForIETLSCourseController::class, 'index'])->name('enrolled-students-for-ietls-courses');
Route::get('/enrolled-students-for-ietls-courses/{course_name}', [EnrolledStudentsForIETLSCourseController::class, 'show'])->name('enrolled-students-for-ietls-courses.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/enrolled-students-for-ietls-courses/index', [AjaxEnrolledStudentsForIETLSCourseController::class, 'index'])->name('ajax.enrolled-students-for-ietls-courses.index');
// ajax call to append new student(s)
Route::post('/ajax/enrolled-students-for-ietls-courses/append/student', [AjaxEnrolledStudentsForIETLSCourseController::class, 'append'])->name('ajax.enrolled-students-for-ietls-courses.append.student');
// ajax call to suspend student
Route::post('/ajax/enrolled-students-for-ietls-courses/student/suspend', [AjaxEnrolledStudentsForIETLSCourseController::class, 'suspend'])->name('ajax.enrolled-students-for-ietls-courses.student.suspend');
// ajax call to un-suspend student
Route::post('/ajax/enrolled-students-for-ietls-courses/student/un-suspend', [AjaxEnrolledStudentsForIETLSCourseController::class, 'unSuspend'])->name('ajax.enrolled-students-for-ietls-courses.student.un-suspend');
// ajax call to remove student from course
Route::post('/ajax/enrolled-students-for-ietls-courses/student/remove', [AjaxEnrolledStudentsForIETLSCourseController::class, 'remove'])->name('ajax.enrolled-students-for-ietls-courses.student.remove');
/* End Apppend User to IETLS Course Pages */



/* Start Zoom Courses Pages */
Route::get('/zoom-courses', [ZoomCourseController::class, 'index'])->name('zoom-courses');
Route::get('/zoom-course/create', [ZoomCourseController::class, 'create'])->name('zoom-course.create');
Route::get('/zoom-course/show/{slug}', [ZoomCourseController::class, 'show'])->name('zoom-course.show');
Route::get('/zoom-course/show/{slug}/level/{level_slug}', [ZoomCourseController::class, 'level'])->name('zoom-course.level.show');
Route::get('/zoom-course/show/{slug}/level/{level_slug}/session/{session_slug}', [ZoomCourseController::class, 'session'])->name('zoom-course.level.session.show');
Route::get('/zoom-course/show/{slug}/level/{level_slug}/session/{session_slug}/user/{user_id}/answers', [ZoomCourseController::class, 'sessionUserAnswers'])->name('zoom-course.level.session.user.answers');

// ajax call to view all zoom courses
Route::get('/ajax/zoom-course/index', [AjaxZoomCourseController::class, 'index'])->name('ajax.zoom-courses.index');
// ajax call to create new zoom course
Route::post('/ajax/zoom-course/create', [AjaxZoomCourseController::class, 'create'])->name('ajax.zoom-course.create');
// ajax call to update zoom course info
Route::post('/ajax/zoom-course/update/details', [AjaxZoomCourseController::class, 'updateDetails'])->name('ajax.zoom-course.update.details');
// ajax call to update zoom course image
Route::post('/ajax/zoom-course/update/image', [AjaxZoomCourseController::class, 'updateImage'])->name('ajax.zoom-course.update.image');
// ajax call to remove zoom course image
Route::post('/ajax/zoom-course/update/remove', [AjaxZoomCourseController::class, 'removeImage'])->name('ajax.zoom-course.remove.image');
// ajax call to remove zoom course
Route::post('/ajax/zoom-course/delete', [AjaxZoomCourseController::class, 'delete'])->name('ajax.zoom-course.delete');
// ajax call to view all zoom course levels
Route::get('/ajax/zoom-course/{slug}/levels/index', [AjaxZoomCourseController::class, 'levels'])->name('ajax.zoom-course-levels.index');
// ajax call to append new zoom course level
Route::post('/ajax/zoom-course/level/append', [AjaxZoomCourseController::class, 'appendNewLevel'])->name('ajax.zoom-course.level.append');
// ajax call to append new zoom course level
Route::post('/ajax/zoom-course/level/users/append', [AjaxZoomCourseController::class, 'appendUsersInZoomCourseLevel'])->name('ajax.zoom-course.level.users.append');
// ajax call to append new zoom course level
Route::post('/ajax/zoom-course/level/users/remove', [AjaxZoomCourseController::class, 'removeUserInZoomCourseLevel'])->name('ajax.zoom-course.level.users.remove');
// ajax call to update zoom course level info
Route::post('/ajax/zoom-course/level/update', [AjaxZoomCourseController::class, 'updateLevelInfo'])->name('ajax.zoom-course.level.update-info');
// ajax call to delete zoom course level
Route::post('/ajax/zoom-course/level/delete', [AjaxZoomCourseController::class, 'deleteLevel'])->name('ajax.zoom-course.level.delete');
// ajax call to view all zoom course level sessions
Route::get('/ajax/zoom-course/{slug}/level/{level_slug}/sessions/index', [AjaxZoomCourseController::class, 'sessions'])->name('ajax.zoom-course-level.sessions.index');
// ajax call to append new zoom course level session
Route::post('/ajax/zoom-course/level/session/append', [AjaxZoomCourseController::class, 'appendNewLevelSession'])->name('ajax.zoom-course.level.session.append');
// ajax call to append new zoom course session
Route::post('/ajax/zoom-course/level/session/users/append', [AjaxZoomCourseController::class, 'appendUsersInZoomCourseSession'])->name('ajax.zoom-course.level.users.session.append');
// ajax call to delete zoom course level session
Route::post('/ajax/zoom-course/level/session/delete', [AjaxZoomCourseController::class, 'deleteLevelSession'])->name('ajax.zoom-course.level.session.delete');
// ajax call to update zoom course level session info
Route::post('/ajax/zoom-course/level/session/update', [AjaxZoomCourseController::class, 'updateLevelSessionInfo'])->name('ajax.zoom-course.level.session.update-info');
// ajax call to choose zoom course level session exersice
Route::post('/ajax/zoom-course/level/session/choose/msq-exersice', [AjaxZoomCourseController::class, 'chooseSessionExercise'])->name('ajax.zoom-course.level.session.choose.msq-exersice');
/* End Zoom Courses Pages */



/* Start Zoom User Pages */
Route::get('/zoom-course/users', [ZoomCourseUserController::class, 'index'])->name('zoom-course.users');
Route::get('/zoom-course/user/create', [ZoomCourseUserController::class, 'create'])->name('zoom-course.user.create');
Route::get('/zoom-course/user/show/{slug}', [ZoomCourseUserController::class, 'show'])->name('zoom-course.user.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/zoom-course/users/index', [AjaxZoomCourseUserController::class, 'index'])->name('ajax.zoom-course.users.index');
// ajax call to create new zoom course user
Route::post('/ajax/zoom-course/user/create', [AjaxZoomCourseUserController::class, 'create'])->name('ajax.zoom-course.user.create');
// ajax call to update zoom course user info
Route::post('/ajax/zoom-course/user/update-info', [AjaxZoomCourseUserController::class, 'updateInfo'])->name('ajax.zoom-course.user.update-info');
// ajax call to update zoom course user image
Route::post('/ajax/zoom-course/user/update-image', [AjaxZoomCourseUserController::class, 'updateImage'])->name('ajax.zoom-course.user.update-image');
// ajax call to update zoom course delete user
Route::post('/ajax/zoom-course/user/delete', [AjaxZoomCourseUserController::class, 'delete'])->name('ajax.zoom-course.user.delete');
/* End Zoom User Pages */



/* Start Apppend User to Zoom Course Pages */
Route::get('/enrolled-students-for-zoom-courses', [EnrolledStudentsForZoomCourseController::class, 'index'])->name('enrolled-students-for-zoom-courses');
Route::get('/enrolled-students-for-zoom-courses/{course_name}', [EnrolledStudentsForZoomCourseController::class, 'show'])->name('enrolled-students-for-zoom-courses.show');

// ajax call to view view list of all courses with enrolled students
Route::get('/ajax/enrolled-students-for-zoom-courses/index', [AjaxEnrolledStudentsForZoomCourseController::class, 'index'])->name('ajax.enrolled-students-for-zoom-courses.index');
// ajax call to append new student(s)
Route::post('/ajax/enrolled-students-for-zoom-courses/append/student', [AjaxEnrolledStudentsForZoomCourseController::class, 'append'])->name('ajax.enrolled-students-for-zoom-courses.append.student');
// ajax call to suspend student
Route::post('/ajax/enrolled-students-for-zoom-courses/student/suspend', [AjaxEnrolledStudentsForZoomCourseController::class, 'suspend'])->name('ajax.enrolled-students-for-zoom-courses.student.suspend');
// ajax call to un-suspend student
Route::post('/ajax/enrolled-students-for-zoom-courses/student/un-suspend', [AjaxEnrolledStudentsForZoomCourseController::class, 'unSuspend'])->name('ajax.enrolled-students-for-zoom-courses.student.un-suspend');
// ajax call to remove student from course
Route::post('/ajax/enrolled-students-for-zoom-courses/student/remove', [AjaxEnrolledStudentsForZoomCourseController::class, 'remove'])->name('ajax.enrolled-students-for-zoom-courses.student.remove');
/* End Apppend User to Zoom Course Pages */


/* Start Bundles Pages */
Route::get('/bundles', [BundleController::class, 'index'])->name('bundles');
Route::get('/bundle/show/{slug}', [BundleController::class, 'show'])->name('bundle.show');
Route::get('/bundle/create', [BundleController::class, 'create'])->name('bundle.create');
Route::get('/bundle/{slug}/courses', [BundleController::class, 'courses'])->name('bundle.courses');
Route::get('/bundle/{slug}/users', [BundleController::class, 'users'])->name('bundle.users');

// ajax call to view list of all bundles
Route::get('/ajax/bundles/index', [AjaxBundleController::class, 'index'])->name('ajax.bundles.index');
// ajax call to create bundle
Route::post('/ajax/bundles/create', [AjaxBundleController::class, 'create'])->name('ajax.bundle.create');
// ajax call to update bundle info
Route::post('/ajax/bundles/update', [AjaxBundleController::class, 'update'])->name('ajax.bundle.update');
// ajax call to update bundle info
Route::post('/ajax/bundles/delete', [AjaxBundleController::class, 'delete'])->name('ajax.bundle.delete');
// ajax call to add new courses bundle
Route::post('/ajax/bundles/courses/add', [AjaxBundleController::class, 'addNewCourses'])->name('ajax.bundle.courses.add');
// ajax call to remove courses bundle
Route::post('/ajax/bundles/courses/remove', [AjaxBundleController::class, 'removeBundleCourse'])->name('ajax.bundle.courses.remove');
// ajax call to add new users to bundle
Route::post('/ajax/bundles/user/append', [AjaxBundleController::class, 'appendNewUsers'])->name('ajax.bundle.users.append');

// ajax call to remove users bundle
Route::post('/ajax/bundles/users/remove', [AjaxBundleController::class, 'removeBundleuser'])->name('ajax.bundle.users.remove');
// ajax call to delete bundle
Route::post('/ajax/bundles/delete', [AjaxBundleController::class, 'delete'])->name('ajax.bundle.delete');
/* End Bundles Pages */



/* Start Public certificates Pages */
Route::get('/public-certificates', [PublicCertificate::class, 'index'])->name('public-certificates');
Route::get('/public-certificate/create', [PublicCertificate::class, 'create'])->name('public-certificate.create');
Route::get('/public-certificate/show/{slug}', [PublicCertificate::class, 'show'])->name('public-certificate.show');

// ajax call to get the list of all public certificates
Route::get('/ajax/public-certificates/index', [AjaxPublicCertificate::class, 'index'])->name('ajax.public-certificates.index');
// ajax call to create new public certificate
Route::post('/ajax/public-certificate/create', [AjaxPublicCertificate::class, 'create'])->name('ajax.public-certificate.create');
// ajax call to append public certificates to existing user
Route::post('/ajax/public-certificate/append', [AjaxPublicCertificate::class, 'append'])->name('ajax.public-certificate.append');
// ajax call to delete public certificate for existing user
Route::post('/ajax/public-certificate/delete', [AjaxPublicCertificate::class, 'delete'])->name('ajax.public-certificate.delete');
// ajax call to delete all public certificates for existing user
Route::post('/ajax/public-certificate/delete-all', [AjaxPublicCertificate::class, 'deleteAll'])->name('ajax.public-certificate.delete-all');
/* End Public certificates Pages */



/* Start Blogs Pages */
// Blogs Views
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::get('/blog/show/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Categories Views
Route::get('/blog/categories', [CategoryController::class, 'index'])->name('blog.categories');
Route::get('/blog/category/create', [CategoryController::class, 'create'])->name('blog.category.create');

// ajax call to view list of all blogs
Route::get('/ajax/blogs/index', [AjaxBlogController::class, 'index'])->name('ajax.blogs.index');
// ajax call to create new blog
Route::post('/ajax/blog/create', [AjaxBlogController::class, 'create'])->name('ajax.blog.create');
// ajax call to update blog
Route::post('/ajax/blog/update', [AjaxBlogController::class, 'update'])->name('ajax.blog.update');
// ajax call to delete blog
Route::post('/ajax/blog/delete', [AjaxBlogController::class, 'delete'])->name('ajax.blog.delete');
// ajax call to preview media type
Route::post('/ajax/blogs/preview/media-type', [BlogController::class, 'previewMediaType'])->name('ajax.blogs.preview.media-type');
// ajax call to view list of all blogs
Route::get('/ajax/blogs/categories/index', [AjaxCategoryController::class, 'index'])->name('ajax.blogs.categories.index');
// ajax call to create new category
Route::post('/ajax/blog/category/create', [AjaxCategoryController::class, 'create'])->name('ajax.blog.category.create');
// ajax call to delete category
Route::post('/ajax/blog/category/delete', [AjaxCategoryController::class, 'delete'])->name('ajax.blog.category.delete');
/* End Blogs Pages */


/* Start Library Pages */
// Library Views
Route::get('/library', [LibraryController::class, 'index'])->name('library');
Route::get('/library/book/create', [LibraryController::class, 'create'])->name('library.book.create');
Route::get('/library/book/show/{slug}', [LibraryController::class, 'show'])->name('library.book.show');

// ajax call to choose book type
Route::post('/ajax/library/preview/choose-book-type', [AjaxLibraryController::class, 'previewBookType'])->name('ajax.library.preview.choose-book-type');

// ajax call to create new book
Route::post('/ajax/library/book/create', [AjaxLibraryController::class, 'create'])->name('ajax.library.book.create');
// ajax call to update book info
Route::post('/ajax/library/book/update', [AjaxLibraryController::class, 'update'])->name('ajax.library.book.update');
// ajax call to delete book
Route::post('/ajax/library/book/delete', [AjaxLibraryController::class, 'delete'])->name('ajax.library.book.delete');
/* Start Library Pages */



/* Start Exams Pages */
// Exams Views
Route::get('/exams', [ExamController::class, 'index'])->name('exams');
Route::get('/exam/create', [ExamController::class, 'create'])->name('exam.create');
Route::get('/exam/show/{slug}', [ExamController::class, 'show'])->name('exam.show');
Route::get('/exam/preview/{slug}', [ExamController::class, 'preview'])->name('exam.preview');
Route::post('/exam/choose-time-type', [ExamController::class, 'previewExamTimeType'])->name('exam.choose-time-type');

// ajax call to view view list of all exams
Route::get('/ajax/exams/index', [ExamController::class, 'index'])->name('ajax.exams.index');
// ajax call to create new exam
Route::post('/ajax/exam/create', [ExamController::class, 'create'])->name('ajax.exam.create');
// ajax call to update exam
Route::post('/ajax/exam/update', [ExamController::class, 'update'])->name('ajax.exam.update');
// ajax call to delete exam
Route::post('/ajax/exam/delete', [ExamController::class, 'delete'])->name('ajax.exam.delete');
// ajax call to set exam for anyone
Route::post('/ajax/exam/public', [ExamController::class, 'forAnyOne'])->name('ajax.exam.public');
// ajax call to set exam for registed one
Route::post('/ajax/exam/private', [ExamController::class, 'forRegistedUsers'])->name('ajax.exam.private');
// ajax call to publish exam
Route::post('/ajax/exam/publish', [ExamController::class, 'publish'])->name('ajax.exam.publish');
// ajax call to un-publish exam
Route::post('/ajax/exam/un-publish', [ExamController::class, 'unPublish'])->name('ajax.exam.un-publish');
// ajax call to create new exam section
Route::post('/ajax/exam/section/create', [ExamController::class, 'createSection'])->name('ajax.exam.section.create');
// ajax call to update exam section
Route::post('/ajax/exam/section/update', [ExamController::class, 'updateSection'])->name('ajax.exam.section.update');
// ajax call to delete exam section
Route::post('/ajax/exam/section/delete', [ExamController::class, 'deleteSection'])->name('ajax.exam.section.delete');
// ajax call to create new question
Route::post('/ajax/exam/section/question/create', [ExamController::class, 'createQuestion'])->name('ajax.exam.section.question.create');
// ajax call to update question
Route::post('/ajax/exam/section/question/update', [ExamController::class, 'updateQuestion'])->name('ajax.exam.section.question.update');
// ajax call to delete question
Route::post('/ajax/exam/section/question/delete', [ExamController::class, 'deleteQuestion'])->name('ajax.exam.section.question.delete');
// ajax call to update question score
Route::post('/ajax/exam/question/score/update', [ExamController::class, 'updateQuestionScore'])->name('ajax.exam.question.score.update');
// ajax call to update answer
Route::post('/ajax/exam/answer/update', [ExamController::class, 'updateAnswer'])->name('ajax.exam.answer.update');
// ajax call to delete answer
Route::post('/ajax/exam/answer/delete', [ExamController::class, 'deleteAnswer'])->name('ajax.exam.answer.delete');
// ajax call to update correct answer
Route::post('/ajax/exam/correct-answer/update', [ExamController::class, 'updateCorrectAnswer'])->name('ajax.exam.correct-answer.update');
/* End Exams Pages */


/* Start Register Users Pages */
// Register Users Exams Views
Route::get('/registed-users-exams', [RegistedUserExamController::class, 'index'])->name('registed-users-exams');
Route::get('/registed-users-exam/{slug}', [RegistedUserExamController::class, 'show'])->name('registed-users.show');

// ajax call to view view list of all registed users exams
Route::get('/ajax/registed-users-exams/index', [AjaxRegistedUserExamController::class, 'index'])->name('ajax.registed-users-exams.index');
// ajax call to append registed users in exam
Route::post('/ajax/registed-users-exam/append', [AjaxRegistedUserExamController::class, 'append'])->name('ajax.registed-users-exam.append');
// ajax call to remove registed user from exam
Route::post('/ajax/registed-users-exam/remove', [AjaxRegistedUserExamController::class, 'remove'])->name('ajax.registed-users-exam.remove');
/* End Register Users Pages */



/* Start Exams Builder Pages */
Route::get('/survey-js/all-surveys', [SurveyController::class, 'index'])->name('survey-js.index');
Route::get('/survey-js/create', [SurveyController::class, 'create'])->name('survey-js.create');
Route::get('/survey-js/{slug}/show', [SurveyController::class, 'show'])->name('survey-js.show');
Route::get('/survey-js/{slug}/preview', [SurveyController::class, 'preview'])->name('survey-js.preview');
Route::get('/survey-js/{slug}/users', [SurveyController::class, 'surveyUsers'])->name('survey-js.users');
Route::get('/survey-js/{slug}/user/{user_slug}', [SurveyController::class, 'surveyUser'])->name('survey-js.user.show');

// ajax call to view survey-js surveys datatables
Route::get('/datatable/survey-js/surveys', [SurveyController::class, 'datatable'])->name('datatable.survey-js.surveys');
// ajax call to view all users in specific survey-js datatables
Route::get('/datatable/survey-js/survey/{slug}/users', [SurveyController::class, 'surveyUserDatatable'])->name('datatable.survey-js.survey.users');
// ajax call to create new survey.js
Route::post('/ajax/survey-js/create', [SurveyController::class, 'ajaxCreateSurvey'])->name('ajax.survey-js.create');
// ajax call to update survey
Route::post('/ajax/survey-js/update', [SurveyController::class, 'update'])->name('ajax.survey-js.update');
// ajax call to delete survey
Route::post('/ajax/survey-js/delete', [SurveyController::class, 'delete'])->name('ajax.survey-js.delete');
// ajax call to correct user answers
Route::post('/ajax/survey-js/correct-user-answers', [SurveyController::class, 'correctUserAnswers'])->name('ajax.survey-js.correct-user-answers');
/* End Exams Builder Pages */



/* Start Exercise Builder Pages */
Route::get('/exercise/all-exercises', [ExerciseController::class, 'index'])->name('exercise.index');
Route::get('/exercise/create', [ExerciseController::class, 'create'])->name('exercise.create');
Route::get('/exercise/{slug}/show', [ExerciseController::class, 'show'])->name('exercise.show');
Route::get('/exercise/{slug}/preview', [ExerciseController::class, 'preview'])->name('exercise.preview');
Route::get('/exercise/{slug}/users', [ExerciseController::class, 'exerciseUsers'])->name('exercise.users');
Route::get('/exercise/{slug}/user/{user_slug}', [ExerciseController::class, 'exerciseUser'])->name('exercise.user.show');

// ajax call to view exercise datatables
Route::get('/datatable/exercise/exercises', [ExerciseController::class, 'datatable'])->name('datatable.excercises');
// ajax call to view all users in specific exercise datatables
Route::get('/datatable/exercise/exercise/{slug}/users', [ExerciseController::class, 'exerciseUserDatatable'])->name('datatable.exercise.exercise.users');
// ajax call to create new exercise
Route::post('/ajax/exercise/create', [ExerciseController::class, 'ajaxCreateExcercise'])->name('ajax.exercise.create');
// ajax call to update exercise
Route::post('/ajax/exercise/update', [ExerciseController::class, 'update'])->name('ajax.exercise.update');
// ajax call to delete exercise
Route::post('/ajax/exercise/delete', [ExerciseController::class, 'delete'])->name('ajax.exercise.delete');
// ajax call to correct user answers
Route::post('/ajax/exercise/correct-user-answers', [ExerciseController::class, 'correctUserAnswers'])->name('ajax.exercise.correct-user-answers');
/* End Exercise Builder Pages */


/* Start Settings Pages */
// Settings Views
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::get('/settings/change/email', [SettingsController::class, 'email'])->name('settings.change-email');
Route::get('/settings/change/password', [SettingsController::class, 'password'])->name('settings.change-password');

// Ajax Calls
Route::post('/ajax.settings/change/name', [AjaxSettingsController::class, 'changeUserName'])->name('ajax.settings.change-name');
Route::post('/ajax.settings/change/email', [AjaxSettingsController::class, 'changeEmail'])->name('ajax.settings.change-email');
Route::post('/ajax.settings/change/password', [AjaxSettingsController::class, 'changePassword'])->name('ajax.settings.change-password');
Route::post('/ajax.settings/change/image', [AjaxSettingsController::class, 'changeUserImage'])->name('ajax.settings.change-image');
/* End Settings Pages */

// Admin::firstOrCreate(['email' => 'admin@'.config('app.domain')], [
//     'name' => 'Admin',
//     'email' => 'admin@'.config('app.domain'),
//     'password' => Hash::make('secret123'),
//     'image' => null
// ]);

Auth::routes([
    'register' => false
]);

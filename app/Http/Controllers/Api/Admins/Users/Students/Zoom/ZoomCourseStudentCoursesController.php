<?php

namespace App\Http\Controllers\Api\Admins\Users\Students\Zoom;

use App\Exceptions\AdminDashboard\Users\Students\Zoom\Courses\StudentDoesnotEnrolledToCourseException;
use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AdminDashboard\Users\Students\Zoom\Courses\UpdateUserCourseStatus;
use App\Models\ZoomCourses\LiveCourseUserCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;

class ZoomCourseStudentCoursesController extends ApiController
{

    /**
     * @param int $studentId
     * @return JsonResponse
     */
    public function index($studentId)
    {
        if (auth('sanctum')->user()->cannot('index', ZoomCourseUser::class))
            throw new UnauthorizedException();

        $student = ZoomCourseUser::with([
                'courses:id,title',
                'courses.levels' => function (HasMany $levels) use ($studentId) {
                    $levels->select(['id', 'zoom_course_id', 'title']);
                    $levels->whereHas('groups.students', function (Builder $student) use ($studentId) {
                        $student->where('id', $studentId);
                    })->orWhereHas('privates', function (Builder $private) use ($studentId) {
                        $private->where('live_course_user_id', $studentId);
                    });
                },
                'courses.levels.groups' => function (HasMany $groups) use ($studentId) {
                    $groups->select(['id', 'zoom_course_level_id', 'name', 'instructor_id']);
                    $groups->whereHas('students', function (Builder $student) use ($studentId) {
                        $student->where('id', $studentId);
                    });
                    $groups->with([
                        'instructor:id,name',
                        'instructor.info:coach_id,image'
                    ]);
                },
                'courses.levels.privates' => function (HasMany $privates) use ($studentId) {
                    $privates->select(['id', 'zoom_course_level_id', 'live_course_user_id', 'instructor_id']);
                    $privates->where('live_course_user_id', $studentId);
                    $privates->with([
                        'instructor:id,name',
                        'instructor.info:coach_id,image'
                    ]);
                },
            ])->find($studentId) ?? throw new NotFoundException(ZoomCourseUser::class, $studentId);

        return $this->apiSuccessResponse(
            [
                'courses' => $student->courses
            ]
        );
    }

    public function update(int $studentId, UpdateUserCourseStatus $request)
    {
        $student = ZoomCourseUser::with([
            'courses' => function (BelongsToMany $course) use ($request) {
                $course->where('course_id', $request->course_id);
                $course->select(['id']);
            }
        ])->find($studentId, ['id']);
        
        // throw NotFoundException if student doesn't exists
        if (! $student)
            throw new NotFoundException(ZoomCourseUser::class, $studentId);
        
        /*
        throw StudentDoesnotEnrolledToCourseException if 
        student doesn't enrolled to requested course
        */
        $course = $student->courses->first() ?? throw new StudentDoesnotEnrolledToCourseException();

        // handle updates
        $course->info->status = $request->status;

        switch ($request->status) {
            case LiveCourseUserCourse::STATUS_DELAYED:
                $course->info->delayed_at = now();
                break;

            case LiveCourseUserCourse::STATUS_FINISHED:
                $course->info->finished_at = now();
                break;
        }

        $course->push();
        return $this->apiSuccessResponse();
    }
}

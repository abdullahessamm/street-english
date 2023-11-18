<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\ApiController;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;

class StudentsController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $students = ZoomCourseUser::whereHas('groups', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })
            ->orWhereHas('privates', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })
            ->get(['id', 'name', 'image']);

        return $this->apiSuccessResponse([
            'students' => $students
        ]);
    }

    /**
     * @param int $studentId
     * @return JsonResponse
     * @throws UnauthorizedException
     */
    public function show(int $studentId): JsonResponse
    {
        $student = ZoomCourseUser::with([
                'sessionsReports' => function (HasMany $q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->with([
                        'session:id,zoom_course_level_id,title',
                        'session.level:id,zoom_course_id,title',
                        'session.level.course:id,title'
                    ]);
                },
                'levelsReports' => function (HasMany $q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->with([
                        'level:id,zoom_course_id,title',
                        'level.course:id,title'
                    ]);
                },
                'solvedExercises' => function (HasMany $q) {
                    $q->whereHas('session.level.groups', function (Builder $q) {
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                    })->orWhereHas('session.level.privates', function (Builder $q) {
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                    });
                    $q->with([
                        'session:id,zoom_course_level_id,title',
                        'session.level:id,zoom_course_id,title',
                        'session.level.course:id,title'
                    ]);
                    $q->orderByRaw('ISNULL(corrected_at) ASC, corrected_at DESC');
                },
                'solvedExams' => function (HasMany $q) {
                    $q->whereHas('level.groups', function (Builder $q) {
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                    })->orWhereHas('level.privates', function (Builder $q) {
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                    });
                    $q->with([
                        'level:id,zoom_course_id,title',
                        'level.course:id,title'
                    ]);
                    $q->orderByRaw('ISNULL(corrected_at) ASC, corrected_at DESC');
                },
            ])
            ->whereHas('groups', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })
            ->orWhereHas('privates', function (Builder $q) {
                $q->where('instructor_id', auth('sanctum')->user()->id);
            })
            ->get( ['id', 'name', 'image'])
            ->where('id', $studentId)
            ->first();

        if (! $student)
            throw new UnauthorizedException();

        // student's courses
        $student->courses = ZoomCourse::with([
            'levels' => function (HasMany $q) use ($studentId) {
                $q->select(['id', 'zoom_course_id', 'title']);
                $q->whereHas('groups', function (Builder $q) use ($studentId) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->whereHas('students', function (Builder $q) use ($studentId) {
                        $q->where('id', $studentId);
                    });
                });
                $q->orWhereHas('privates', function (Builder $q) use ($studentId) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                    $q->where('live_course_user_id', $studentId);
                });
            },
            'levels.sessions:id,zoom_course_level_id,title'
        ])->whereHas('levels.groups', function ($q) use ($studentId) {
            $q->where('instructor_id', auth('sanctum')->user()->id);
            $q->whereHas('students', function (Builder $q) use ($studentId) {
                $q->where('id', $studentId);
            });
        })->orWhereHas('levels.privates', function ($q) use ($studentId) {
            $q->where('instructor_id', auth('sanctum')->user()->id);
            $q->where('live_course_user_id', $studentId);
        })->get(['id', 'title']);

        return $this->apiSuccessResponse([
            'student' => $student
        ]);
    }
}

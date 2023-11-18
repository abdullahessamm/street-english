<?php

namespace App\Http\Controllers\Api\Instructors\Courses\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Exceptions\Models\NotFoundException;
use App\Http\Controllers\Api\ApiController;
use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;

class ZoomCoursesController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $instructor = auth('sanctum')->user();
        $courses = ZoomCourse::whereHas('levels.groups', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })->orWhereHas('levels.privates', function ($q) use ($instructor) {
            $q->where('instructor_id', $instructor->id);
        })->get(['id', 'title']);

        return $this->apiSuccessResponse([
            "courses" => $courses
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws NotFoundException
     * @throws UnauthorizedException
     */
    public function show(int $id): JsonResponse
    {
        $course = ZoomCourse::find($id, ['id', 'title']);
        if (! $course)
            throw new NotFoundException(ZoomCourse::class, $id);

        if (! auth('sanctum')->user()->can('instructor-view', $course))
            throw new UnauthorizedException();

        $course->load([
            'levels' => function (HasMany $q) {
                $q->select(['id', 'zoom_course_id', 'title']);
                $q->with([
                    'sessions:id,zoom_course_level_id,title',
                    'sessions.groupsInfo:id,zoom_course_level_id,name',
                    'sessions.privatesInfo:id,zoom_course_level_id,live_course_user_id,instructor_id',
                    'sessions.privatesInfo.student:id,name,image',
                    'sessions.materials:id,session_id,title,type',
                    'sessions.exercises' => function (BelongsToMany $q) {
                        $q->select(['id', 'full_mark']);
                        $q->wherePivot('opened', 1);
                        $q->with([
                            'sections:id,title,score',
                            'sections.header',
                            'sections.questions:id,exam_section_id,title,type,score,content'
                        ]);
                    },
                    'groups' => function (HasMany $q) {
                        $q->select(['id', 'zoom_course_level_id', 'instructor_id', 'name']);
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                        $q->with([
                            'students:id,name,image',
                            'sessions:id,zoom_course_level_id,title'
                        ]);
                    },
                    'privates' => function (HasMany $q) {
                        $q->select(['id', 'zoom_course_level_id', 'instructor_id', 'live_course_user_id']);
                        $q->where('instructor_id', auth('sanctum')->user()->id);
                        $q->with([
                            'student:id,name,image',
                            'sessions:id,zoom_course_level_id,title'
                        ]);
                    },
                ])->whereHas('groups', function ($q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                })->orWhereHas('privates', function ($q) {
                    $q->where('instructor_id', auth('sanctum')->user()->id);
                });
            },
        ]);

        return $this->apiSuccessResponse([
            'course' => $course
        ]);
    }
}

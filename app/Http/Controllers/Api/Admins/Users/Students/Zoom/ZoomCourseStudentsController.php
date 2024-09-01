<?php

namespace App\Http\Controllers\Api\Admins\Users\Students\Zoom;

use App\Exceptions\Authorization\UnauthorizedException;
use App\Http\Controllers\Api\Admins\Users\Students\StudentController;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ZoomCourseStudentsController extends StudentController
{

    protected string $modelClassName = ZoomCourseUser::class;

    public function __construct()
    {
        $this->abilities['index'] = auth('sanctum')->user()?->can('index', ZoomCourseUser::class) ?? false;
        $this->abilities['store'] = auth('sanctum')->user()?->can('create', ZoomCourseUser::class) ?? false;
        $this->abilities['show']  = auth('sanctum')->user()?->can('index', ZoomCourseUser::class) ?? false;
        $this->abilities['update'] = auth('sanctum')->user()?->can('update', ZoomCourseUser::class) ?? false;
        $this->abilities['destroy'] = auth('sanctum')->user()?->can('delete', ZoomCourseUser::class) ?? false;
        $this->abilities['updateProfilePic'] = auth('sanctum')->user()?->can('update', ZoomCourseUser::class) ?? false;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \App\Exceptions\Authorization\UnauthorizedException
     */
    public function show($id)
    {
        if (! $this->abilities['show'])
            throw new UnauthorizedException();

            return $this->apiSuccessResponse([
                'student' => ZoomCourseUser::with([
                    // courses
                    'courses:id,title',
                    'courses.levels' => function (HasMany $levels) use ($id) {
                        $levels->select(['id', 'zoom_course_id', 'title']);
                        $levels->whereHas('groups.students', function (Builder $student) use ($id) {
                            $student->where('id', $id);
                        })->orWhereHas('privates', function (Builder $private) use ($id) {
                            $private->where('live_course_user_id', $id);
                        });
                    },
                    'courses.levels.groups' => function (HasMany $groups) use ($id) {
                        $groups->select(['id', 'zoom_course_level_id', 'name', 'instructor_id']);
                        $groups->whereHas('students', function (Builder $student) use ($id) {
                            $student->where('id', $id);
                        });
                        $groups->with([
                            'instructor:id,name',
                            'instructor.info:coach_id,image'
                        ]);
                    },
                    'courses.levels.privates' => function (HasMany $privates) use ($id) {
                        $privates->select(['id', 'zoom_course_level_id', 'live_course_user_id', 'instructor_id']);
                        $privates->where('live_course_user_id', $id);
                        $privates->with([
                            'instructor:id,name',
                            'instructor.info:coach_id,image'
                        ]);
                    },
                    // sessions reports
                    'sessionsReports' => function (HasMany $q) {
                        $q->select(['id', 'live_course_user_id', 'session_id', 'instructor_id']);
                        $q->with([
                            'session:id,zoom_course_level_id,title',
                            'session.level:id,zoom_course_id,title',
                            'session.level.course:id,title',
                            'instructor:id,name',
                            'instructor.info:coach_id,image'
                        ]);
                    },
                    // levels reports
                    'levelsReports' => function (HasMany $q) {
                        $q->select(['id', 'live_course_user_id', 'level_id', 'instructor_id']);
                        $q->with([
                            'level:id,zoom_course_id,title',
                            'level.course:id,title',
                            'instructor:id,name',
                            'instructor.info:coach_id,image'
                        ]);
                    },
                ])->find($id)
            ]);
    }
}

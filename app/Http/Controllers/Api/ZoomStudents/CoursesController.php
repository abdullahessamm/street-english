<?php

namespace App\Http\Controllers\Api\ZoomStudents;

use App\Http\Controllers\Api\ApiController;
use App\Models\Exams\Exam;
use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseLevel;
use App\Models\ZoomCourses\ZoomCourseLevelStudentExam;
use App\Models\ZoomCourses\ZoomCourseSession;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;

class CoursesController extends ApiController
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $student = auth('sanctum')->user();
        $courses = ZoomCourse::whereHas('levels.groups.students', function ($q) use ($student) {
            $q->where('id', $student->id);
        })->orWhereHas('levels.privates', function ($q) use ($student) {
            $q->where('live_course_user_id', $student->id);
        })->get(['id', 'title']);

        return $this->apiSuccessResponse([
            "courses" => $courses
        ]);
    }

    public function show(int $id)
    {
        $student = auth('sanctum')->user();
        $course = ZoomCourse::with([
            'levels' => function (HasMany $q) use ($student) {
                $q->select(['id', 'zoom_course_id', 'title']);
                $q->with([
                    'sessions:id,zoom_course_level_id,title',
                    'sessions.groupsInfo' => function (BelongsToMany $q) use ($student) {
                        $q->select(['id', 'zoom_course_level_id']);
                        $q->whereHas('students', function (Builder $q) use ($student) {
                            $q->where('id', $student->id);
                        });
                    },
                    'sessions.privatesInfo' => function (BelongsToMany $q) use ($student) {
                        $q->select(['id', 'zoom_course_level_id', 'live_course_user_id']);
                        $q->where('live_course_user_id', $student->id);
                    },
                    'sessions.materials:id,session_id,title,type',
                    'sessions.exercises' => function (BelongsToMany $q) {
                        $q->select(['id', 'full_mark']);
                        $q->wherePivot('opened', true);
                        $q->with([
                            'sections:id,title,score',
                            'sections.header',
                            'sections.questions:id,exam_section_id,title,type,score,content'
                        ]);
                    },
                    'groups' => function (HasMany $q) use ($student) {
                        $q->select(['id', 'zoom_course_level_id', 'instructor_id', 'name']);
                        $q->whereHas('students', function (Builder $q) use ($student) {
                            $q->where('id', $student->id);
                        });
                        $q->with([
                            'instructor:id,name',
                            'instructor.info:id,coach_id,image'
                        ]);
                    },
                    'privates' => function (HasMany $q) use ($student) {
                        $q->select(['id', 'zoom_course_level_id', 'instructor_id', 'live_course_user_id']);
                        $q->where('live_course_user_id', $student->id);
                        $q->with([
                            'instructor:id,name',
                            'instructor.info:id,coach_id,image'
                        ]);
                    },
                ])->whereHas('groups.students', function (Builder $q) use ($student) {
                    $q->where('id', $student->id);
                })->orWhereHas('privates', function (Builder $q) use ($student) {
                    $q->where('live_course_user_id', $student->id);
                });
            },
        ])->whereHas('levels.groups.students', function (Builder $q) use ($student) {
            $q->where('id', $student->id);
        })->orWhereHas('levels.privates', function (Builder $q) use ($student) {
            $q->where('live_course_user_id', $student->id);
        })->get(['id', 'title'])->where('id', $id)->first();

        if ($course) {
            // handle levels and it's sessions data.
            $course->levels->each(function (ZoomCourseLevel $level) {
                // sanitize student's group
                $level->setAttribute('group', $level->getAttribute('groups')->first());
                unset($level->groups);
                // sanitize student's private
                $level->setAttribute('private', $level->getAttribute('privates')->first());
                unset($level->privates);
                // sanitize sessions data
                $level->getAttribute('sessions')->each(function (ZoomCourseSession $session) {
                    $session->setAttribute('info', $session->getAttribute('groupsInfo')->first()?->info ?? $session->getAttribute('privatesInfo')->first()?->info);
                    unset($session->groupsInfo, $session->privatesInfo);
                    // set solved exercise attribute
                    $session->getAttribute('exercises')->each(function (Exam $exam) {
                        $exam->setAttribute('solved',
                            auth('sanctum')->user()->solvedExercises()
                                ->where('session_id', $exam->info->session_id)
                                ->where('exam_id', $exam->id)
                                ->exists()
                        );
                    });
                });
                // load exam
                if (
                    ! ZoomCourseLevelStudentExam::where('level_id', $level->id)
                        ->where('student_id', auth('sanctum')->user()->id)->first()
                ) {
                    $level->load('exam');
                    if ($level->exam?->start_at->addMinutes($level->exam?->start_at)->isPast())
                        unset($level->exam);
                }
            });
        }

        return $this->apiSuccessResponse([
            "course" => $course
        ]);
    }
}

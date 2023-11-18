<?php

namespace App\Policies\Traits\Instructors\Exams\Zoom;

use App\Models\Coaches\Coach;
use App\Models\ZoomCourses\ZoomCourseSessionStudentExercise;
use Illuminate\Database\Eloquent\Builder;

trait ZoomCourseSessionStudentExercises {

    public function correct(Coach $instructor, ZoomCourseSessionStudentExercise $studentExercise)
    {
        // get instructor's groups and privates that in session's level
        // that contains the student
        $groupsContainsStudent = $instructor->groups()
        ->whereHas('level.sessions', function (Builder $session) use ($studentExercise) {
            $session->where('id', $studentExercise->session_id);
        })->whereHas('students', function (Builder $student) use ($studentExercise) {
            $student->where('id', $studentExercise->student_id);
        })->get();

        $privatesContainsStudent = $instructor->privates()->whereHas('level.sessions', function (Builder $session) use ($studentExercise) {
            $session->where('id', $studentExercise->session_id);
        })->where('live_course_user_id', $studentExercise->student_id)
        ->get();

        return !! $groupsContainsStudent->count() || !! $privatesContainsStudent->count();
    }
}
<?php

namespace App\Policies\Traits\Instructors\Exams\Zoom;

use App\Models\Coaches\Coach;
use App\Models\ZoomCourses\ZoomCourseLevelStudentExam as StudentExam;
use Illuminate\Database\Eloquent\Builder;

trait ZoomCourseLevelStudentExam
{

    public function correct(Coach $instructor, StudentExam $exam)
    {
        // get count of level groups that contains the student
        $groupsCount = $instructor->groups()
            ->where('zoom_course_level_id', $exam->level_id)
            ->whereHas('students', function (Builder $student) use ($exam) {
                $student->where('id', $exam->student_id);
            })
            ->count();

        $privatesCount = $instructor->privates()
            ->where('zoom_course_level_id', $exam->level_id)
            ->where('live_course_user_id', $exam->student_id)
            ->count();

        return !! $groupsCount || !! $privatesCount;
    }
}

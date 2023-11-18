<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\ExamSectionQuestion;
use App\Models\MultiPrimaryKeysModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZoomCourseLevelExamAnswer extends MultiPrimaryKeysModel
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = [
        'zoom_course_level_student_exam_id', 'exam_section_question_id'
    ];

    protected $fillable = [
        'zoom_course_level_student_exam_id',
        'exam_section_question_id',
        'student_answer',
        'instructor_correction',
        'score'
    ];

    public function studentExam()
    {
        return $this->belongsTo(ZoomCourseLevelStudentExam::class, 'zoom_course_level_student_exam_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(ExamSectionQuestion::class, 'exam_section_question_id', 'id');
    }
}

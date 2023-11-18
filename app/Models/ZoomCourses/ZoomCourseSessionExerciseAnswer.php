<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\ExamSectionQuestion;
use App\Models\MultiPrimaryKeysModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZoomCourseSessionExerciseAnswer extends MultiPrimaryKeysModel
{
    use HasFactory;

    protected $table = 'zoom_course_session_exercise_answers';
    
    protected $primaryKey = [
        'student_exercise_id', 'exam_section_question_id'
    ];

    public $timestamps = false;

    protected $fillable = [
        'student_exercise_id',
        'exam_section_question_id',
        'student_answer',
        'instructor_correction',
        'score',
    ];

    public function studentExercise()
    {
        return $this->belongsTo(ZoomCourseSessionStudentExercise::class, 'student_exercise_id', 'id');
    }

    public function question()
    {
        return $this->belongsTo(ExamSectionQuestion::class, 'exam_section_question_id', 'id');
    }
}

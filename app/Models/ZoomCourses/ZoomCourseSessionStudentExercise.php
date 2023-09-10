<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseSessionStudentExercise extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_session_exercise_student_infos';
    
    public $timestamps = false;
    
    protected $fillable = [
        'session_id',
        'exam_id',
        'student_id',
        'joined_at',
        'finished_at',
        'score',
        'corrected_by',
        'corrected_at',
    ];

    protected $casts = [
        'joined_at',
        'finished_at',
        'corrected_at',
    ];

    public function session()
    {
        return $this->belongsTo(ZoomCourseSession::class, 'session_id', 'id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'student_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(ZoomCourseSessionExerciseAnswer::class, 'student_exercise_id', 'id');
    }
}

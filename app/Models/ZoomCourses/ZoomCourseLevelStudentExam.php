<?php

namespace App\Models\ZoomCourses;

use App\Models\Coaches\Coach;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelStudentExam extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'student_id',
        'joined_at',
        'finished_at',
        'score',
        'corrected_by',
        'corrected_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'finished_at' => 'datetime',
        'corrected_at' => 'datetime'
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'level_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(ZoomCourseUser::class, 'student_id', 'id');
    }

    public function corrector()
    {
        return $this->belongsTo(Coach::class, 'corrected_by', 'id');
    }

    public function answers()
    {
        return $this->hasMany(ZoomCourseLevelExamAnswer::class, 'zoom_course_level_student_exam_id', 'id');
    }
}

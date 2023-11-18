<?php

namespace App\Models\ZoomCourses;

use App\Models\Exams\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomCourseLevelExam extends Model
{
    use HasFactory;

    protected $table = 'zoom_course_level_exams';

    protected $primaryKey = 'level_id';

    public $timestamps = false;

    protected $fillable = [
        'level_id',
        'exam_id',
        'start_at',
        'student_can_start_until',
        'duration',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'student_can_start_until' => 'datetime',
    ];

    public function level()
    {
        return $this->belongsTo(ZoomCourseLevel::class, 'level_id', 'id');
    }

    public function content()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    /**
     * @return bool
     */
    public function isEnded(): bool
    {
        return $this->start_at->addMinutes($this->duration)->isPast();
    }
}

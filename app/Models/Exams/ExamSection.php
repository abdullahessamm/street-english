<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Model;

class ExamSection extends Model
{
    protected $table = 'exam_sections';

    protected $fillable = [
        'exam_id', 'section_name'
    ];

    public function belongsToExam()
    {
        return $this->belongsTo(Exam::class, 'exam_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(ExamQuestion::class, 'section_id', 'id');
    }
}

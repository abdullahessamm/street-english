<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSectionQuestion extends Model
{
    use HasFactory;

    CONST AVAILABLE_TYPES = [
        'open-ended', 'mcq', 'complete', 'match'
    ];

    protected $table = 'exam_section_questions';

    public $timestamps = false;

    protected $casts = [
        'content' => 'array',
        'correct_answer' => 'array',
    ];

    protected $fillable = [
        'exam_section_id',
        'title',
        'type',
        'score',
        'content',
        'correct_answer',
    ];

    public function section()
    {
        return $this->belongsTo(ExamSection::class);
    }

}

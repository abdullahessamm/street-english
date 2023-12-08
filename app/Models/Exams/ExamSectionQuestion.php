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

    CONST TYPE_OPEN_ENDED = 'open-ended';
    CONST TYPE_MCQ = 'mcq';
    CONST TYPE_COMPLETE = 'complete';
    CONST TYPE_MATCH = 'match';

    protected $table = 'exam_section_questions';

    public $timestamps = false;

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
        return $this->belongsTo(ExamSection::class, 'exam_section_id', 'id');
    }

}

<?php

namespace App\Models\Exams;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'name', 'full_mark'
    ];

    public function sections()
    {
        return $this
            ->belongsToMany(ExamSection::class, ExamSectionPivot::class, 'exam_id', 'exam_section_id')
            ->withPivot('order');
    }
}

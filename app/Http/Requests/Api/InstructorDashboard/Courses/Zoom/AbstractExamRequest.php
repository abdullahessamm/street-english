<?php

namespace App\Http\Requests\Api\InstructorDashboard\Courses\Zoom;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractExamRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            "answers"                   => ['required', 'array', 'min:1'],
            "answers.*.question_id"     => ['required', 'integer', 'exists:exam_section_questions,id'],
            "answers.*.correction"      => ['required', 'array'],
            "answers.*.correction.*"    => ['boolean'],
            "answers.*.score"           => ['required', 'integer', 'max:255']
        ];
    }
}

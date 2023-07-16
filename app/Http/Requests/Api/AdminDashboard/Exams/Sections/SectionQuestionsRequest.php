<?php

namespace App\Http\Requests\Api\AdminDashboard\Exams\Sections;

use Illuminate\Validation\Rule;
use App\Models\Exams\ExamSectionQuestion;
use Illuminate\Foundation\Http\FormRequest;

class SectionQuestionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questions' => ['required', 'array', 'min:1'],
            'questions.*' => ['array'],
            'questions.*.id' => ['integer', 'exists:exam_section_questions,id'],
            'questions.*.title' => ['required', 'string', 'min:2', 'max:80'],
            'questions.*.type' => ['required', 'string', Rule::in(ExamSectionQuestion::AVAILABLE_TYPES)],
            'questions.*.score' => ['required', 'numeric', 'min:0', 'max:999.99'],
            'questions.*.content' => ['required', 'json'],
            'questions.*.correct_answer' => ['required', 'json'],
        ];
    }
}

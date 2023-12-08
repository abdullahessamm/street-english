<?php

namespace App\Http\Requests\Api\ZoomUserDashboard\Exercise;

use Illuminate\Foundation\Http\FormRequest;

class ExerciseAnswerRequest extends FormRequest
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
            'session_id'                => 'required|integer|exists:zoom_course_sessions,id',
            'exam_id'                   => 'required|integer|exists:exams,id',
            'joined_at'                 => 'required|date',
            'finished_at'               => 'required|date|after:joined_at',
            'answers'                   => 'required|array|min:1',
            'answers.*.question_id'     => 'required|integer',
            'answers.*.answer'          => 'array'
        ];
    }
}

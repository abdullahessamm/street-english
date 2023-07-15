<?php

namespace App\Http\Requests\Api\AdminDashboard\Exams;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamRequest extends FormRequest
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
            'name' => ['string', 'min:2', 'max:50'],
            'full_mark' => ['integer', 'min:1', 'max:255'],
            'sections' => ['array'],
            'sections.*' => ['array'],
            'sections.*.id' => ['required', 'integer', 'exists:exam_sections,id'],
            'sections.*.order' => ['required', 'integer', 'min:1', 'max:255'],
        ];
    }
}

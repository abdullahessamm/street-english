<?php

namespace App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports;

use Illuminate\Foundation\Http\FormRequest;

class CreateLevelReportRequest extends FormRequest
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
            "level_id"            => ['required', 'integer', 'exists:zoom_course_levels,id'],
            "live_course_user_id"   => ['required', 'integer', 'exists:live_course_users,id'],
            "weakness_points"       => ['nullable', 'array', 'max:32'],
            "weakness_points.*"     => ['string', 'min:1', 'max:2000'],
            "strength_points"       => ['nullable', 'array', 'max:32'],
            "strength_points.*"     => ['string', 'min:1', 'max:2000'],
            "notes"                 => ['nullable', 'string', 'max:65000']
        ];
    }
}

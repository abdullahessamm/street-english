<?php

namespace App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Reports;

use Illuminate\Foundation\Http\FormRequest;

class CreateSessionReportRequest extends FormRequest
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
            "session_id"            => ['required', 'integer', 'exists:zoom_course_sessions,id'],
            "live_course_user_id"   => ['required', 'integer', 'exists:live_course_users,id'],
            "attended_at"           => ['nullable', 'date'],
            "lateness"              => ['nullable', 'integer', 'max:255'],
            "did_assignment"        => ['nullable', 'boolean'],
            "participation"         => ['nullable', 'integer', 'max:100'],
            "weakness_points"       => ['nullable', 'array', 'max:32'],
            "weakness_points.*"     => ['string', 'min:1', 'max:2000'],
            "strength_points"       => ['nullable', 'array', 'max:32'],
            "strength_points.*"     => ['string', 'min:1', 'max:2000'],
            "notes"                 => ['nullable', 'string', 'max:200']
        ];
    }
}

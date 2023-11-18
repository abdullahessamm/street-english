<?php

namespace App\Http\Requests\Api\InstructorDashboard\Courses\Zoom\Groups;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSessionInfoRequest extends FormRequest
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
            "sessions"              => ["array"],
            "sessions.*.id"         => ["required", "integer", "exists:zoom_course_sessions,id"],
            "sessions.*.time"       => ["nullable", "date", "after:now"],
            "sessions.*.duration"   => ["nullable", "integer", "min:1", "max:255"],
            "sessions.*.room_link"  => ["nullable", "url"],
        ];
    }
}

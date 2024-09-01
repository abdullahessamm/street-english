<?php

namespace App\Http\Requests\Api\AdminDashboard\Users\Students\Zoom\Courses;

use App\Models\ZoomCourses\LiveCourseUserCourse;
use App\Models\ZoomCourses\ZoomCourseUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserCourseStatus extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->user()->can('update', ZoomCourseUser::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'course_id' => ['required', 'exists:live_course_user_courses,course_id'],
            'status'    => ['required', Rule::in(LiveCourseUserCourse::AVAILABLE_STATUS)]
        ];
    }
}

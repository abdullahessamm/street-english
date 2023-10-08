<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session;

use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth('sanctum')->user()->can('update', ZoomCourse::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "title"                 => ["string", "max:255"],
            "description"           => ["nullable", "max:65000"],
            "exercises"             => ["array"],
            "exercises.*.exam_id"   => ["required", "integer", "exists:exams,id"],
            "exercises.*.title"     => ["required", "string", "max:50"],
            "exercises.*.opened"    => ["required", "boolean"]
        ];
    }
}

<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session;

use App\Models\ZoomCourses\ZoomCourse;
use Illuminate\Foundation\Http\FormRequest;

class UploadYallaNzakerVideoRequest extends FormRequest
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
            "session_id" => ["required", "integer", "exists:zoom_course_sessions"],
            "title"      => ["required", "string", "max:255"],
            "video"      => [
                "required",
                "file",
                'mimetypes:video/mpeg,video/mp4,video/webm',
                'max:' . config('media.max_video_size')
            ]
        ];
    }
}

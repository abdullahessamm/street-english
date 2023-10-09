<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Session;

use App\Models\ZoomCourses\ZoomCourse;
use App\Models\ZoomCourses\ZoomCourseSessionMaterial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadMaterialRequest extends FormRequest
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
            "session_id" => ["required", "integer", "exists:zoom_course_sessions,id"],
            "title" => ["required", "string", "max:255"],
            "type"  => ["required", Rule::in(ZoomCourseSessionMaterial::AVAILABLE_TYPES)],
            "video" => [
                "required_if:type," . ZoomCourseSessionMaterial::TYPE_VIEDO,
                "file",
                'mimetypes:video/mpeg,video/mp4,video/webm',
                'max:' . config('media.max_video_size')
            ],
            "audio" => [
                "required_if:type," . ZoomCourseSessionMaterial::TYPE_AUDIO,
                "file",
                'mimetypes:audio/mpeg,audio/wav',
                'max:' . config('media.max_audio_size')
            ],
            "book" => [
                "required_if:type," . ZoomCourseSessionMaterial::TYPE_BOOK,
                "file",
                'mimetypes:application/pdf',
                'max:' . config('media.max_pdf_size')
            ],
        ];
    }
}

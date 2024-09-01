<?php

namespace App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage;

use Illuminate\Foundation\Http\FormRequest;

class UploadTestimonialStudentImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('sanctum')->user()->abilities === "*";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "id"        => ["required", "integer"],
            "image"     => [
                "image",
                "mimes:jpeg,jpg",
                "max:" . config('media.max_image_size')
            ]
        ];
    }
}

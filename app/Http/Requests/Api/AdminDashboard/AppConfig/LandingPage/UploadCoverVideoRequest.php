<?php

namespace App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage;

use Illuminate\Foundation\Http\FormRequest;

class UploadCoverVideoRequest extends FormRequest
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
            'video' => 'required|mimes:mp4,mov,ogg,webm',
            "max:" . config('media.max_video_size')
        ];
    }
}

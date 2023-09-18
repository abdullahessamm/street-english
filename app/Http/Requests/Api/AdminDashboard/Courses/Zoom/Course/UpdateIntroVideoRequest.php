<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIntroVideoRequest extends FormRequest
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
            'video' => [
                'file',
                'mimetypes:video/mpeg,video/mp4,video/webm',
                'max:204800'
            ],
        ];
    }
}

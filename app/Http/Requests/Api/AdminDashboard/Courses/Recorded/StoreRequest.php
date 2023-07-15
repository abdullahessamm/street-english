<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Recorded;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'course_category_id' => ['required', 'numeric', 'exists:course_categories,id'],
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:1', 'max:80'],
            'duration' => ['required', 'regex:/^[0-9a-zA-Z\s]+$/', 'min:1', 'max:255'],
            'level' => ['required', 'regex:/^[0-9a-zA-Z\s]+$/', 'min:1', 'max:255'],
            'language' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'min:1', 'max:50'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'discount' => ['nullable', 'numeric', 'min:0', 'max:99999.99'],
            'thumbnail' => ['required', 'file', 'mimes:jpg,jpeg,png,svg', 'max:' . config('media.max_image_size')],
            'media_intro' => ['required', 'in:image,video'],
            'image' => ['required_if:media_intro,image', 'file', 'mimes:jpg,jpeg,png,svg', 'max:' . config('media.max_image_size')],
            'video' => ['required_if:media_intro,video', 'file', 'mimetypes:video/mpeg,video/mp4,video/webm', 'max:' . config('media.max_video_size')],
            'description' => ['required', 'string', 'min:7', 'max:65500'],
            'isPublished' => ['required', 'boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests\Api\AdminDashboard\AppConfig\LandingPage;

use Illuminate\Foundation\Http\FormRequest;

class LandingPageUpdateRequest extends FormRequest
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
            'most_popular_courses_ids'      => ['array', 'max:12'],
            'most_popular_courses_ids.*'    => ['integer', 'exists:zoom_courses,id'],
            'testimonials'                  => ['array', 'max:9'],
            'testimonials.*.id'             => ['required', 'integer'],
            'testimonials.*.student_name'   => ['required', 'string', 'max:20'],
            'testimonials.*.message'        => ['required', 'string', 'max:574'],
            'latest_videos_links'           => ['array', 'max:3'],
            'latest_videos_links.*'         => ['url'],
            'facebook_latest_posts'         => ['array', 'max:6'],
            'facebook_latest_posts.*.id'    => ['required', 'integer'],
            'facebook_latest_posts.*.url'   => ['required', 'url']
        ];
    }
}

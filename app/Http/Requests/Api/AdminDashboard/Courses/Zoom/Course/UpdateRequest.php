<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'                         => ['string', 'min:1', 'max:100'],
            'description'                   => ['string', 'min:1', 'max:65000'],
            'private_price'                 => ['numeric', 'between:0.01,999999.99'],
            'private_price_per_level'       => ['numeric', 'between:0.01,999999.99'],
            'group_price'                   => ['numeric', 'between:0.01,999999.99'],
            'group_price_per_level'         => ['numeric', 'between:0.01,999999.99'],
            'isPublished'                   => ['boolean'],
            // create levels
            'levels.create'                 => ['array', 'min:1'],
            'levels.create.*.title'         => ['required', 'string', 'min:1', 'max:255'],
            'levels.create.*.description'   => ['string', 'min:1', 'max:65000'],
            // update levels
            'levels.update'                 => ['array', 'min:1'],
            'levels.update.*.id'            => ['required', 'integer', 'exists:zoom_course_levels,id'],
            'levels.update.*.title'         => ['string', 'min:1', 'max:255'],
            'levels.update.*.description'   => ['nullable', 'string', 'min:1', 'max:65000'],
            // delete levels
            'levels.delete'                 => ['array', 'min:1'],
            'levels.delete.*'               => ['integer', 'exists:zoom_course_levels,id'],
        ];
    }
}

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
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'                         => ['string', 'min:1', 'max:100'],
            'description'                   => ['string', 'min:1', 'max:65000'],
            'video'                         => ['nullable', 'url'],
            'private_price_per_level'       => ['numeric', 'between:0.01,999999.99'],
            'group_price_per_level'         => ['numeric', 'between:0.01,999999.99'],
            'has_offer_for_group'           => ['boolean'],
            'group_offer_levels'            => ['required_if:has_offer_for_group,true', 'integer', 'min:2', 'max:255'],
            'group_offer_price'             => ['required_if:has_offer_for_group,true', 'numeric', 'between:0.01,999999.99'],
            'has_offer_for_private'         => ['boolean'],
            'private_offer_levels'          => ['required_if:has_offer_for_private,true', 'integer', 'min:2', 'max:255'],
            'private_offer_price'           => ['required_if:has_offer_for_private,true', 'numeric', 'between:0.01,999999.99'],
            'isPublished'                   => ['boolean'],
            // create levels
            'levels.create'                 => ['array'],
            'levels.create.*.title'         => ['required', 'string', 'min:1', 'max:255'],
            'levels.create.*.description'   => ['string', 'min:1', 'max:65000'],
            // update levels
            'levels.update'                 => ['array'],
            'levels.update.*.id'            => ['required', 'integer', 'exists:zoom_course_levels,id'],
            'levels.update.*.title'         => ['string', 'min:1', 'max:255'],
            'levels.update.*.description'   => ['nullable', 'string', 'min:1', 'max:65000'],
            // delete levels
            'levels.delete'                 => ['array'],
            'levels.delete.*'               => ['integer', 'exists:zoom_course_levels,id'],
        ];
    }
}

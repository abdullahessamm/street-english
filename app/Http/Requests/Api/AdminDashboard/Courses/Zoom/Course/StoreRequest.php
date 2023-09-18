<?php

namespace App\Http\Requests\Api\AdminDashboard\Courses\Zoom\Course;

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
            'title'                     => ['required', 'string', 'min:1', 'max:100'],
            'description'               => ['required', 'string', 'min:1', 'max:65000'],
            'private_price_per_level'   => ['required', 'numeric', 'between:0.01,999999.99'],
            'group_price_per_level'     => ['required', 'numeric', 'between:0.01,999999.99'],
            'has_offer_for_group'       => ['boolean'],
            'group_offer_levels'        => ['required_if:has_offer_for_group,true', 'integer', 'min:2', 'max:255'],
            'group_offer_price'         => ['required_if:has_offer_for_group,true', 'numeric', 'between:0.01,999999.99'],
            'has_offer_for_private'     => ['boolean'],
            'private_offer_levels'      => ['required_if:has_offer_for_private,true', 'integer', 'min:2', 'max:255'],
            'private_offer_price'       => ['required_if:has_offer_for_private,true', 'numeric', 'between:0.01,999999.99'],
            'levels'                    => ['required', 'array', 'min:1'],
            'levels.*.title'            => ['required', 'string', 'min:1', 'max:255'],
            'levels.*.description'      => ['string', 'min:1', 'max:65000'],
        ];
    }
}

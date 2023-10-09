<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaginationRequest extends FormRequest
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
            'per_page' => ['nullable', 'numeric'],
            'page' => ['nullable', 'required_with:per_page', 'numeric'],
            'search' => ['string', 'max:255'],
            'full_object' => ['boolean']
        ];
    }
}

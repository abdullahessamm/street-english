<?php

namespace App\Http\Requests\Api\AdminDashboard\Exams\Sections;

use Illuminate\Validation\Rule;
use App\Models\Exams\ExamSectionHeader;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['nullable', 'string', 'min:1', 'max:255'],
            'score' => ['numeric', 'min:0', 'max:999.99'],
            // Header
            'header' => ['array', 'nullable'],
            'header.title' => ['nullable', 'string', 'min:1', 'max:255'],
            'header.type' => ['string', Rule::in(ExamSectionHeader::AVAILABLE_TYPES)],
            'header_paragraph' => [
                'required_if:header_type,' . ExamSectionHeader::TYPE_PARAGRAPH,
                'string',
                'min:1',
                'max:65535'
            ],
            'header_picture' => [
                'required_if:header_type,' . ExamSectionHeader::TYPE_PICTURE,
                'image',
                'max:' . config('media.max_image_size')
            ],
            'header_video' => [
                'required_if:header_type,' . ExamSectionHeader::TYPE_VIDEO,
                'file',
                'mimetypes:video/mpeg,video/mp4,video/webm',
                'max:' . config('media.max_video_size')
            ],
            'header_audio' => [
                'required_if:header_type,' . ExamSectionHeader::TYPE_AUDIO,
                'file',
                'mimetypes:audio/mpeg,audio/wav',
                'max:' . config('media.max_audio_size'),
            ],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CompressImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],

            'quality' => [
                'required',
                'integer',
                'min:10',
                'max:100',
            ],
        ];
    }


public function messages(): array{
    return [
            'image.required' =>
                'Please select an image.',

            'image.image' =>
                'The uploaded file must be an image.',

            'image.mimes' =>
                'Only JPG, JPEG, PNG and WebP images are allowed.',

            'image.max' =>
                'The image must not be larger than 10 MB.',

            'quality.min' =>
                'Compression quality must be at least 10.',

            'quality.max' =>
                'Compression quality cannot exceed 100.',
    ];
}

}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResizeImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],

            'width' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],

            'height' => [
                'required',
                'integer',
                'min:1',
                'max:5000',
            ],
        ];
    }
}
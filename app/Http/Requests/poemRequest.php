<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class poemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'poem_title' => 'required|string',
            'poem_content' => 'text|required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'poem_link' => 'nullable|string',

        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CharacterCarouselRequest extends FormRequest
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
            'image' => $this->isMethod('post')
                ? 'required|image|mimes:jpeg,jpg,png,webp|max:10240'
                : 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',

            'title' => 'required|string|max:255',
            'order' => 'required|integer|min:0',
            'is_active' => 'nullable|boolean',
        ];
    }
}

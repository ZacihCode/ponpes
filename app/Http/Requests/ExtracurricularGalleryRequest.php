<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExtracurricularGalleryRequest extends FormRequest
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
        $isUpdate = $this->route('gallery') !== null;

        return [
            'image' => $isUpdate
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:10240',

            'order' => 'required|integer|min:0',
        ];
    }
}

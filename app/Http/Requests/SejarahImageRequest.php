<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SejarahImageRequest extends FormRequest
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
            'urutan' => ['nullable', 'integer', 'min:0'],
            'gambar' => [
                $this->isMethod('post') ? 'required' : 'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'gambar.required' => 'Gambar wajib dipilih.',
            'gambar.image'    => 'File harus berupa gambar.',
            'gambar.mimes'    => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'      => 'Ukuran gambar maksimal 10MB.',
            'urutan.integer'  => 'Urutan harus berupa angka.',
        ];
    }
}

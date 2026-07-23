<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PrestasiRequest extends FormRequest
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
            'judul'     => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'urutan'    => ['required', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'     => 'Judul wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'urutan.required'    => 'Urutan wajib diisi.',
            'urutan.integer'     => 'Urutan harus angka.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}

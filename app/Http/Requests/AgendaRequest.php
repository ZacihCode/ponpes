<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AgendaRequest extends FormRequest
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
            'isi'       => ['required', 'string'],
            'tipe'      => ['required', 'in:info,warning,success'],
            'urutan'    => ['required', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'  => 'Judul wajib diisi.',
            'isi.required'    => 'Isi agenda wajib diisi.',
            'tipe.required'   => 'Tipe wajib dipilih.',
            'tipe.in'         => 'Tipe tidak valid.',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer'  => 'Urutan harus angka.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }
}

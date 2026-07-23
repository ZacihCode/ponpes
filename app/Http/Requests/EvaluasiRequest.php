<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EvaluasiRequest extends FormRequest
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
            'tipe' => ['required', 'in:kolom_kiri,kolom_kanan'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'urutan' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipe.required' => 'Tipe kolom wajib dipilih.',
            'tipe.in' => 'Tipe kolom tidak valid.',
            'judul.required' => 'Judul wajib diisi.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'urutan.required' => 'Urutan wajib diisi.',
            'urutan.integer' => 'Urutan harus angka.',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class OstdaquPositionRequest extends FormRequest
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
            'jabatan' => 'required|string|max:100',
            'nama' => 'required|string|max:100',
            'icon' => 'required|string|max:10',
            'tipe' => 'required|in:ketua,anggota',
            'urutan' => 'required|integer|min:0',
            'aktif' => 'boolean',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KetuaAsramaRequest extends FormRequest
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
            'nama_asrama' => 'required|string|max:100',
            'nama_ketua' => 'required|string|max:100',
            'icon' => 'required|string|max:10',
            'urutan' => 'required|integer|min:0',
            'aktif' => 'boolean',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GaleriRequest extends FormRequest
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

        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'judul'     => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'kategori'  => ['nullable', 'string', 'max:100'],
            'urutan'    => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'foto'      => [
                $isUpdate ? 'nullable' : 'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:10240',
            ],
        ];
    }
    
    public function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? true : false,
            'urutan'    => $this->urutan ?? 0,
        ]);
    }

    public function messages(): array
    {
        return [
            'judul.required'  => 'Judul galeri wajib diisi.',
            'foto.required'   => 'Foto wajib diunggah.',
            'foto.image'      => 'File harus berupa gambar.',
            'foto.mimes'      => 'Format foto harus jpg, jpeg, png, atau webp.',
            'foto.max'        => 'Ukuran foto maksimal 2MB.',
        ];
    }
}

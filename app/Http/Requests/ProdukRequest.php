<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProdukRequest extends FormRequest
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
        $isUpdate = $this->method('PUT') || $this->method('PATCH');

        return [
            'kategori'  => ['required', 'string', 'max:100'],
            'nama'      => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'harga'     => ['required', 'integer', 'min:0'],
            'badge'     => ['nullable', 'string', 'max:50'],
            'urutan'    => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'gambar'    => [
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
            'urutan' => $this->urutan ?? 0,
        ]);
    }

    public function messages(): array
    {
        return [
            'kategori.required'  => 'Kategori produk wajib diisi.',
            'nama.required'      => 'Nama produk wajib diisi.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga.required'     => 'Harga produk wajib diisi.',
            'harga.integer'      => 'Harga harus berupa angka.',
            'gambar.required'    => 'Gambar produk wajib diunggah.',
            'gambar.image'       => 'File harus berupa gambar.',
            'gambar.mimes'       => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'gambar.max'         => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}

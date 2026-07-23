<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InfoSantriRequest extends FormRequest
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
            'foto' => $isUpdate
                        ? ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240']
                        : ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'kategori' => ['required', 'string', 'max:100'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'nama' => ['required', 'string', 'max:150'],
            'kelas' => ['required', 'string', 'max:100'],
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:' . (date('Y') + 1)],
        ];
    }

     public function messages(): array
    {
        return [
            'foto.required'        => 'Foto prestasi wajib diisi.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.mimes'           => 'Format gambar harus jpg, jpeg, png, atau webp.',
            'foto.max'             => 'Ukuran gambar maksimal 10MB.',
            'kategori.required'    => 'Kategori wajib diisi.',
            'judul.required'       => 'Judul prestasi wajib diisi.',
            'deskripsi.required'   => 'Deskripsi wajib diisi.',
            'nama_santri.required' => 'Nama santri wajib diisi.',
            'kelas.required'       => 'Kelas wajib diisi.',
            'tahun.required'       => 'Tahun wajib diisi.',
            'tahun.digits'         => 'Tahun harus 4 digit.',
            'tahun.integer'        => 'Tahun harus berupa angka.',
            'tahun.min'            => 'Tahun minimal 2000.',
            'tahun.max'            => 'Tahun tidak boleh melebihi ' . (date('Y') + 1) . '.',
        ];
    }
}

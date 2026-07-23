<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
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
            'tipe'               => ['required', 'in:sebaran,kiprah'],
            'nama'               => ['required', 'string', 'max:255'],
            'tahun_lulus'        => ['required', 'digits:4', 'integer', 'min:2000', 'max:' . date('Y')],
            'badge'              => ['nullable', 'string', 'max:100'],
            'profesi_atau_kampus'=> ['required', 'string', 'max:255'],
            'deskripsi'          => ['nullable', 'string'],
            'hafalan_juz'        => ['required', 'integer', 'min:0', 'max:30'],
            'foto'               => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'urutan'             => ['nullable', 'integer', 'min:0'],
            'is_active'          => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'tipe.required'                => 'Tipe alumni wajib dipilih.',
            'tipe.in'                      => 'Tipe harus sebaran atau kiprah.',
            'nama.required'                => 'Nama alumni wajib diisi.',
            'tahun_lulus.required'         => 'Tahun lulus wajib diisi.',
            'tahun_lulus.digits'           => 'Tahun lulus harus 4 digit.',
            'profesi_atau_kampus.required' => 'Profesi / kampus wajib diisi.',
            'hafalan_juz.max'              => 'Hafalan juz maksimal 30.',
            'foto.image'                   => 'File harus berupa gambar.',
            'foto.max'                     => 'Ukuran foto maksimal 2MB.',
        ];
    }
}

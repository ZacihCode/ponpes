<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SejarahRequest extends FormRequest
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
        $rules = [
            'judul'  => ['required', 'string', 'max:255'],
            'konten' => ['required', 'string'],
        ];

        if ($this->isMethod('post')) {
            // Hanya berlaku saat STORE (buat data baru)
            $rules['tipe'] = ['required', 'in:pesantren,yayasan', 'unique:sejarahs,tipe'];
        } else {
            // Saat UPDATE, 'tipe' sama sekali tidak boleh dikirim/diubah
            $rules['tipe'] = ['prohibited'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'judul.required'  => 'Judul wajib diisi.',
            'konten.required' => 'Konten wajib diisi.',
            'tipe.required'   => 'Tipe sejarah wajib dipilih.',
            'tipe.in'         => 'Tipe sejarah tidak valid.',
            'tipe.unique'     => 'Data untuk tipe ini sudah ada, silakan edit data yang sudah ada.',
            'tipe.prohibited' => 'Tipe sejarah tidak boleh diubah.',
        ];
    }
}

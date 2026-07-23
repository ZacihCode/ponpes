<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BeritaRequest extends FormRequest
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
            'judul'           => ['required', 'string', 'max:255'],
            'excerpt'         => ['required', 'string', 'max:500'],
            'konten'          => ['nullable', 'string'],
            'tanggal_publish' => ['required', 'date'],
            'status'          => ['required', 'in:terbit,draf'],
            'gambar'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul.required'           => 'Judul berita wajib diisi.',
            'excerpt.required'         => 'Ringkasan berita wajib diisi.',
            'tanggal_publish.required' => 'Tanggal terbit wajib diisi.',
            'status.required'          => 'Status berita wajib dipilih.',
            'gambar.image'             => 'File harus berupa gambar.',
            'gambar.max'               => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}

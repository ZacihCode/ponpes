<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MudabbirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Saat create: 'nama' adalah array (banyak nama untuk 1 kamar)
        // Saat update: 'nama' adalah string (1 row spesifik)
        if ($this->isMethod('post')) {
            return [
                'kamar'    => 'required|string|max:50',
                'nama'     => 'required|array|min:1',
                'nama.*'   => 'required|string|max:100',
                'urutan'   => 'required|integer|min:0',
                'aktif'    => 'boolean',
            ];
        }

        return [
            'kamar'  => 'required|string|max:50',
            'nama'   => 'required|string|max:100',
            'urutan' => 'required|integer|min:0',
            'aktif'  => 'boolean',
        ];
    }
}
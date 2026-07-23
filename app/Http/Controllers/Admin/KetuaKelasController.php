<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KetuaKelasRequest;
use App\Models\KetuaKelas;

class KetuaKelasController extends Controller
{
    public function create()
    {
        return view('backend.organisasi-santri.ketua-kelas.create');
    }

    public function store(KetuaKelasRequest $request)
    {
        KetuaKelas::create([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua kelas berhasil ditambahkan.');
    }

    public function edit(KetuaKelas $ketuaKela)
    {
        return view('backend.organisasi-santri.ketua-kelas.edit', ['ketua' => $ketuaKela]);
    }

    public function update(KetuaKelasRequest $request, KetuaKelas $ketuaKela)
    {
        $ketuaKela->update([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua kelas berhasil diperbarui.');
    }

    public function destroy(KetuaKelas $ketuaKela)
    {
        $ketuaKela->delete();

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua kelas berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KetuaAsramaRequest;
use App\Models\KetuaAsrama;

class KetuaAsramaController extends Controller
{
    public function create()
    {
        return view('backend.organisasi-santri.ketua-asrama.create');
    }

    public function store(KetuaAsramaRequest $request)
    {
        KetuaAsrama::create([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua asrama berhasil ditambahkan.');
    }

    public function edit(KetuaAsrama $ketuaAsrama)
    {
        return view('backend.organisasi-santri.ketua-asrama.edit', compact('ketuaAsrama'));
    }

    public function update(KetuaAsramaRequest $request, KetuaAsrama $ketuaAsrama)
    {
        $ketuaAsrama->update([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua asrama berhasil diperbarui.');
    }

    public function destroy(KetuaAsrama $ketuaAsrama)
    {
        $ketuaAsrama->delete();

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Ketua asrama berhasil dihapus.');
    }
}

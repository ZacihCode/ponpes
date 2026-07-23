<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MudabbirRequest;
use App\Models\Mudabbir;

class MudabbirController extends Controller
{
    public function create()
    {
        return view('backend.organisasi-santri.mudabbir.create');
    }

    public function store(MudabbirRequest $request)
    {
        $namaList = $request->input('nama'); // array nama-nama ustadz
        $urutanAwal = $request->input('urutan', 0);

        foreach ($namaList as $index => $nama) {
            Mudabbir::create([
                'kamar'  => $request->input('kamar'),
                'nama'   => $nama,
                'urutan' => $urutanAwal + $index,
                'aktif'  => $request->boolean('aktif'),
            ]);
        }

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', count($namaList) . ' mudabbir berhasil ditambahkan.');
    }

    public function edit(Mudabbir $mudabbir)
    {
        return view('backend.organisasi-santri.mudabbir.edit', compact('mudabbir'));
    }

    public function update(MudabbirRequest $request, Mudabbir $mudabbir)
    {
        $mudabbir->update([
            'kamar'  => $request->input('kamar'),
            'nama'   => $request->input('nama'),
            'urutan' => $request->input('urutan'),
            'aktif'  => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
                         ->with('success', 'Mudabbir berhasil diperbarui.');
    }

    public function destroy(Mudabbir $mudabbir)
    {
        $mudabbir->delete();

        return redirect()->route('admin.organisasi-santri.index')
                         ->with('success', 'Mudabbir berhasil dihapus.');
    }
}
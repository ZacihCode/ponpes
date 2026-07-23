<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OstdaquPositionRequest;
use App\Models\OstdaquPosition;

class OstdaquPositionController extends Controller
{
    public function create()
    {
        return view('backend.organisasi-santri.ostdaqu.create');
    }

    public function store(OstdaquPositionRequest $request)
    {
        OstdaquPosition::create([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Jabatan OSTDAQU berhasil ditambahkan.');
    }

    public function edit(OstdaquPosition $ostdaqu)
    {
        return view('backend.organisasi-santri.ostdaqu.edit', compact('ostdaqu'));
    }

    public function update(OstdaquPositionRequest $request, OstdaquPosition $ostdaqu)
    {
        $ostdaqu->update([
            ...$request->validated(),
            'aktif' => $request->boolean('aktif'),
        ]);

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Jabatan OSTDAQU berhasil diperbarui.');
    }

    public function destroy(OstdaquPosition $ostdaqu)
    {
        $ostdaqu->delete();

        return redirect()->route('admin.organisasi-santri.index')
            ->with('success', 'Jabatan OSTDAQU berhasil dihapus.');
    }
}

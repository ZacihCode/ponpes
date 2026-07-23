<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evaluasi;
use App\Http\Requests\EvaluasiRequest;

class EvaluasiController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('backend.info-akademik.evaluasi.create');
    }

    public function store(EvaluasiRequest $request)
    {
        Evaluasi::create($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data evaluasi berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Evaluasi $evaluasi)
    {
        return view('backend.info-akademik.evaluasi.edit', compact('evaluasi'));
    }

    public function update(EvaluasiRequest $request, Evaluasi $evaluasi)
    {
        $evaluasi->update($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data evaluasi berhasil diperbarui.');
    }

    public function destroy(Evaluasi $evaluasi)
    {
        $evaluasi->delete();

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data evaluasi berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Http\Requests\KurikulumRequest;

class KurikulumController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('backend.info-akademik.kurikulum.create');
    }

    public function store(KurikulumRequest $request)
    {
        Kurikulum::create($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data kurikulum berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Kurikulum $kurikulum)
    {
        return view(
            'backend.info-akademik.kurikulum.edit',
            compact('kurikulum')
        );
    }

    public function update(KurikulumRequest $request, Kurikulum $kurikulum)
    {
        $kurikulum->update($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data kurikulum berhasil diperbarui.');
    }

    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data kurikulum berhasil dihapus.');
    }
}
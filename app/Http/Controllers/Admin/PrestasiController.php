<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use App\Http\Requests\PrestasiRequest;


class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.info-akademik.prestasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestasiRequest $request)
    {
        Prestasi::create($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestasi $prestasi)
    {
        return view('backend.info-akademik.prestasi.edit', compact('prestasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        $prestasi->update($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}

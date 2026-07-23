<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InfoSantriRequest;
use App\Models\InfoSantri;
use Illuminate\Support\Facades\Storage;

class InfoSantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $infoSantris = InfoSantri::orderBy('urutan', 'desc')->get();
        return view('backend.info-santri.index', compact('infoSantris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.info-santri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfoSantriRequest $request)
    {
        $data = $request->validated();
        $data['foto'] = $request->file('foto')->store('info-santri', 'public');
        $data['urutan'] = InfoSantri::max('urutan') + 1;

        InfoSantri::create($data);

        return redirect()
            ->route('admin.info-santri.index')
            ->with('success', 'Info Santri berhasil ditambahkan');
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
    public function edit(InfoSantri $infoSantri)
    {
        return view('backend.info-santri.edit', compact('infoSantri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoSantriRequest $request, InfoSantri $infoSantri)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($infoSantri->foto);
            $data['foto'] = $request->file('foto')->store('info-santri', 'public');
        } else {
            $data['foto'] = $infoSantri->foto;
        }

        $infoSantri->update($data);

        return redirect()
            ->route('admin.info-santri.index')
            ->with('success', 'Info Santri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InfoSantri $infoSantri)
    {
        Storage::disk('public')->delete($infoSantri->foto);

        $infoSantri->delete();

        return redirect()
            ->route('admin.info-santri.index')
            ->with('success', 'Info Santri berhasil dihapus');
    }
}

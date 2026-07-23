<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;
use App\Models\SejarahImage;
use App\Http\Requests\SejarahImageRequest;
use Illuminate\Support\Facades\Storage;


class SejarahImageController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SejarahImageRequest $request, Sejarah $sejarah)
    {
        $path = $request->file('gambar')->store('sejarah', 'public');
        $urutanTerakhir = $sejarah->images()->max('urutan');

        $sejarah->images()->create([
            'gambar' => $path,
            'urutan' => $urutanTerakhir !== null ? $urutanTerakhir + 1 : 0,
        ]);

        return back()
            ->with('success', "Gambar berhasil ditambahkan.");
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SejarahImageRequest $request, SejarahImage $image)
    {
        $data = [];

        if ($request->filled('urutan')) {
            $data['urutan'] = $request->validated('urutan');
        }

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($image->gambar);
            $data['gambar'] = $request->file('gambar')->store('sejarah', 'public');
        }

        if (!empty($data)) {
            $image->update($data);
        }

        return back()
            ->with('success', "Gambar berhasil diperbarui.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SejarahImage $image)
    {
        if ($image->sejarah->images()->count() <= 1) {
            return back()
                ->with('error', 'Minimal harus ada satu gambar di carousel.');
        }

        Storage::disk('public')->delete($image->gambar);
        $image->delete();

        return back()
            ->with('success', "Gambar berhasil dihapus.");
    }
}

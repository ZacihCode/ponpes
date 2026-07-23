<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Http\Requests\GaleriRequest;
use Illuminate\Support\Facades\Storage;


class GaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galeris = Galeri::orderBy('urutan')->orderBy('created_at', 'desc')->paginate(12);

        return view('backend.galeri.index', compact('galeris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.galeri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GaleriRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dibuat');
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
    public function edit(Galeri $galeri)
    {
        return view('backend.galeri.edit', compact('galeri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GaleriRequest $request, Galeri $galeri)
    {
        $data = $request->validated();

        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }
            // upload foto baru
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        } else {
            // pertahankan foto lama
            unset($data['foto']);
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto galeri berhasil dihapus');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders'   => ['required', 'array'],
            'orders.*' => ['integer', 'exists:galeris,id'],
        ]);

        foreach ($request->orders as $urutan => $id) {
            Galeri::where('id', $id)->update(['urutan' => $urutan + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleActive(Galeri $galeri)
    {
        $galeri->update(['is_active' => !$galeri->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $galeri->is_active,
        ]);
    }
}

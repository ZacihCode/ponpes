<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::order()->paginate(10);

        return view('backend.produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukRequest $request)
    {
        $data = $request->validated();
        
        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dibuat');
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
    public function edit(Produk $produk)
    {
        return view('backend.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProdukRequest $request, Produk $produk)
    {
        $data = $request->validated();

        if($request->hasFile('gambar')) {
            // hapus gambar lama
            if($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // simpan gambar baru
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        } else {
            // pertahankan gambar lama
            unset($data['gambar']);
        }

        $produk->update($data);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        if($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'orders'   => ['required', 'array'],
            'orders.*' => ['integer', 'exists:produks,id'],
        ]);

        foreach ($request->orders as $urutan => $id) {
            Produk::where('id', $id)->update(['urutan' => $urutan + 1]);
        }

        return response()->json(['success' => true]);
    }

    public function toggleActive(Produk $produk)
    {
        $produk->update(['is_active' => !$produk->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $produk->is_active,
        ]);
    }
}

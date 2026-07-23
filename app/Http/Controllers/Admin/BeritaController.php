<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BeritaRequest;
use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Berita::latest('tanggal_publish');

        // filter pencarian
        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        // filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $beritas = $query->paginate(10)->withQueryString();
        
        $stats = [
            'total' => Berita::count(),
            'terbit' => Berita::where('status', 'terbit')->count(),
            'draf' => Berita::where('status', 'draf')->count(),
        ];

        return view('backend.berita.index', compact('beritas', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('backend.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BeritaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
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
    public function edit(Berita $beritum): View
    {
        return view('backend.berita.edit', ['berita' => $beritum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeritaRequest $request, Berita $beritum): RedirectResponse
    {
        $data = $request->validated();
    
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama
                if ($beritum->gambar) {
                    Storage::disk('public')->delete($beritum->gambar);
                }
                $data['gambar'] = $request->file('gambar')->store('berita', 'public');
            }
    
            $beritum->update($data);
    
            return redirect()
                ->route('admin.berita.index')
                ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $beritum): RedirectResponse
    {
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }
 
        $beritum->delete();
 
        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Berita;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::terbit()
            ->latest('tanggal_publish')
            ->paginate(6);
 
        return view('frontend.news.berita', compact('beritas'));
    }

    // Halaman detail berita
    public function show(string $slug): View
    {
        $berita = Berita::terbit()
            ->where('slug', $slug)
            ->firstOrFail();

        $beritaLainnya = Berita::terbit()
            ->where('id', '!=', $berita->id)
            ->latest('tanggal_publish')
            ->take(4)
            ->get();

        // SESUDAH
        return view('frontend.berita.show', compact('berita', 'beritaLainnya'));
    }
}

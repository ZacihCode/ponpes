<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Extracurricular;
use App\Models\ExtracurricularGallery;

class ExtracurricularGalleryController extends Controller
{
    /**
     * Upload multiple images for extracurricular
     */
    public function store(Request $request, Extracurricular $extracurricular)
    {
        $request->validate([
            'images'   => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('extracurricular/gallery', 'public');

                ExtracurricularGallery::create([
                    'extracurricular_id' => $extracurricular->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    /**
     * Delete single gallery image
     */
    public function destroy(ExtracurricularGallery $gallery)
    {
        // hapus file fisik
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()
            ->back()
            ->with('success', 'Foto berhasil dihapus.');
    }
}
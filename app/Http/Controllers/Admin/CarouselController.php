<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarouselRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Carousel;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::query()
            ->latest()
            ->get();

        return view('backend.carousel.index', compact('carousels'));
    }

    public function create()
    {
        return view('backend.carousel.create');
    }

    public function store(CarouselRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')
            ->store('carousels', 'public');

        $data['is_active'] = $request->boolean('is_active');

        Carousel::create($data);

        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan');
    }

    public function edit(Carousel $carousel)
    {
        return view('backend.carousel.edit', compact('carousel'));
    }

    public function update(CarouselRequest $request, Carousel $carousel)
    {
        $imagePath = $carousel->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
                Storage::disk('public')->delete($carousel->image);
            }

            // Upload gambar baru
            $imagePath = $request->file('image')
                ->store('carousels', 'public');
        }

        $carousel->update([
            'image'     => $imagePath,
            'order'     => $request->order,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil diperbarui');
    }

    public function destroy(Carousel $carousel)
    {
        // Hapus file gambar jika ada
        if ($carousel->image && Storage::disk('public')->exists($carousel->image)) {
            Storage::disk('public')->delete($carousel->image);
        }

        // Hapus dari database
        $carousel->delete();

        return redirect()
            ->route('admin.carousel.index')
            ->with('success', 'Carousel berhasil dihapus');
    }
}
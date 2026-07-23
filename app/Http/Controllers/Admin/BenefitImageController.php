<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BenefitImageRequest;
use App\Models\BenefitImage;


class BenefitImageController extends Controller
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
    public function manage() {
        $images = BenefitImage::all() ->keyBy('position');
        return view( 'backend.benefit-image.create', compact('images') );
        
    }

    public function storeOrUpdate(BenefitImageRequest $request)
    {
        $positions = ['left', 'center', 'right'];

        foreach ($positions as $position) {

            $fieldName = $position . '_image';

            if (! $request->hasFile($fieldName)) {
                continue;
            }

            $existingImage = BenefitImage::where(
                'position',
                $position
            )->first();

            $imagePath = $request->file($fieldName)
                ->store('benefit-images', 'public');

            if ($existingImage) {

                Storage::disk('public')
                    ->delete($existingImage->image);

                $existingImage->update([
                    'image' => $imagePath,
                ]);

            } else {

                BenefitImage::create([
                    'position' => $position,
                    'image' => $imagePath,
                ]);

            }
        }

        return redirect()
            ->route('admin.benefit.index')
            ->with(
                'success',
                'Gambar benefit berhasil diperbarui'
            );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BenefitImageRequest $request)
    {
        $validated = $request->validated();

        $validated['image'] = $validated['image']
            ->store('benefit-images', 'public');

        BenefitImage::create($validated);

        return redirect()
            ->route('admin.benefit.index')
            ->with('success', 'Benefit Berhasil Ditambahkan');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

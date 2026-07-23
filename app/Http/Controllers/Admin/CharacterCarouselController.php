<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CharacterCarouselRequest;
use App\Models\CharacterCarousel;


class CharacterCarouselController extends Controller
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
        return view('backend.character.create-carousel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CharacterCarouselRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $request->file('image')
            ->store('character-carousel', 'public');

        $data['is_active'] = $request->boolean('is_active');

        CharacterCarousel::create($data);

        return redirect()
            ->route('admin.character-section.index')
            ->with('success', 'Data Pendidikan Berakter Berhasil disimpan');
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
    public function edit(CharacterCarousel $characterCarousel)
    {
        return view('backend.character.edit-carousel', compact('characterCarousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CharacterCarouselRequest $request, CharacterCarousel $characterCarousel)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {

            Storage::disk('public')->delete($characterCarousel->image);

            $data['image'] = $request->file('image')
                ->store('character-carousel', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $characterCarousel->update($data);

        return redirect()
            ->route('admin.character-section.index')
            ->with('success', 'Data Pendidikan Berakter Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CharacterCarousel $characterCarousel)
    {
        Storage::disk('public')->delete($characterCarousel->image); 
    
        $characterCarousel->delete();

        return redirect()
            ->route('admin.character-section.index')
            ->with('success', 'Data Pendidikan Berakter Berhasil dihapus');
    }
}

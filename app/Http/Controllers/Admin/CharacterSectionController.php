<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CharacterSection;
use App\Models\CharacterCarousel;
use App\Http\Requests\CharacterSectionRequest;


class CharacterSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = CharacterSection::first();
        $carousels = CharacterCarousel::all();

        return view('backend.character.index', compact('section', 'carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.character.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CharacterSectionRequest $request)
    {
        CharacterSection::create($request->validated());

        return redirect()
            ->route('admin.character-section.index')
            ->with('success', 'Data Pendidikan Berhasil disimpan');
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
    public function edit(CharacterSection $characterSection)
    {
        return view('backend.character.edit', compact('characterSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CharacterSectionRequest $request, CharacterSection $characterSection)
    {
        $characterSection->update($request->validated());

        return redirect()
            ->route('admin.character-section.index')
            ->with('success', 'Data Pendidikan Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

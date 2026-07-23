<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CuriculumSectionRequest;
use App\Models\CuriculumSection;
use App\Models\CuriculumItem;


class CuriculumSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section = CuriculumSection::first();
        $items = CuriculumItem::all();
        return view('backend.curiculum.index', compact('section', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.curiculum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CuriculumSectionRequest $request)
    {
        CuriculumSection::create($request->validated());

        return redirect()
            ->route('admin.curiculum-section.index')
            ->with('success', 'Section Berhasil Ditambahkan');
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
    public function edit()
    {
        $section = CuriculumSection::first();

        if (!$section) {
            return redirect()
                ->route('admin.curiculum-section.index')
                ->with('error', 'Section belum dibuat');
        }

        return view('backend.curiculum.edit', compact('section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CuriculumSectionRequest $request)
    {
        $section = CuriculumSection::first();

        if (!$section) {
            return redirect()
                ->route('admin.curiculum-section.index')
                ->with('error', 'Section belum ditemukan');
        }

        $section->update($request->validated());

        return redirect()
            ->route('admin.curiculum-section.index')
            ->with('success', 'Section berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

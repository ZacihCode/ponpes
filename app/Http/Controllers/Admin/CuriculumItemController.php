<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CuriculumItemRequest;
use App\Models\CuriculumItem;

class CuriculumItemController extends Controller
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
        return view('backend.curiculum.create-item');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CuriculumItemRequest $request)
    {
        CuriculumItem::create([...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.curiculum-section.index')
            ->with('success', 'Data berhasil ditambahkan');
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
    public function edit(CuriculumItem $curiculumItem)
    {
        $item = $curiculumItem;

        return view('backend.curiculum.edit-item', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CuriculumItemRequest $request, CuriculumItem $curiculumItem)
    {
        $curiculumItem->update([...$request->validated(),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('admin.curiculum-section.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CuriculumItem $curiculumItem)
    {
        $curiculumItem->delete();

        return redirect()
            ->route('admin.curiculum-section.index')
            ->with('success', 'Data berhasil dihapus');
    }
}

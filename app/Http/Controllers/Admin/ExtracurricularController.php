<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Extracurricular;
use App\Models\ExtracurricularCategory;
use App\Http\Requests\ExtracurricularRequest;
use Illuminate\Support\Str;

class ExtracurricularController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extracurriculars = Extracurricular::with('category')
            ->join('extracurricular_categories', 'extracurriculars.category_id', '=', 'extracurricular_categories.id')
            ->orderBy('extracurricular_categories.order', 'asc')
            ->orderBy('extracurriculars.order', 'asc')
            ->select('extracurriculars.*')
            ->get();

        return view('backend.extracurriculars.index', compact('extracurriculars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ExtracurricularCategory::orderBy('order')->get();

        return view('backend.extracurriculars.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExtracurricularRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        $extracurricular = Extracurricular::create($data);
        
        return redirect()
            ->route('admin.extracurriculars.edit', $extracurricular)
            ->with('success', 'Ekskul Berhasil Ditambahkan. Silakan upload foto galeri di bawah.');
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
    public function edit(Extracurricular $extracurricular)
    {
        $categories = ExtracurricularCategory::orderBy('order')->get();

        $extracurricular->load('galleries');

        return view('backend.extracurriculars.edit', compact('extracurricular', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExtracurricularRequest $request, Extracurricular $extracurricular)
    {
        $data = $request->validated();

        $extracurricular->update($data);
        
        return redirect()
            ->route('admin.extracurriculars.index')
            ->with('success', 'Ekskul Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Extracurricular $extracurricular)
    {
        $extracurricular->delete();
        
        return redirect()
            ->route('admin.extracurriculars.index')
            ->with('success', 'Ekskul Berhasil Dihapus');
    }
}

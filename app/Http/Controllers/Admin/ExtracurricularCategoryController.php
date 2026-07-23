<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\ExtracurricularCategoryRequest;
use App\Models\ExtracurricularCategory;

class ExtracurricularCategoryController extends Controller
{
    public function index()
    {
        $categories = ExtracurricularCategory::orderBy('order')->get();

        return view('backend.extracurricular-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.extracurricular-categories.create');
    }

    public function store(ExtracurricularCategoryRequest $request)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        ExtracurricularCategory::create($data);

        return redirect()
            ->route('admin.extracurricular-categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ExtracurricularCategory $category)
    {
        return view('backend.extracurricular-categories.edit', compact('category'));
    }

    public function update(ExtracurricularCategoryRequest $request, ExtracurricularCategory $category)
    {
        $data = $request->validated();

        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()
            ->route('admin.extracurricular-categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ExtracurricularCategory $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.extracurricular-categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}
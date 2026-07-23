<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Http\Requests\AlumniRequest;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alumni::orderBy('tipe')->orderBy('urutan');

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        $alumnis = $query->paginate(10)->withQueryString();

        return view('backend.alumni.index', compact('alumnis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlumniRequest $request)
    {
        $data = $request->validated();

        // Handle upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        }

        // Checkbox is_active — jika tidak dicentang, nilainya null
        $data['is_active'] = $request->boolean('is_active');

        Alumni::create($data);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil ditambahkan.');
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
    public function edit(Alumni $alumni)
    {
        return view('backend.alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlumniRequest $request, Alumni $alumni)
    {
        $data = $request->validated();

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($alumni->foto) {
                Storage::disk('public')->delete($alumni->foto);
            }
            $data['foto'] = $request->file('foto')->store('alumni', 'public');
        } else {
            // Tetap pakai foto lama
            unset($data['foto']);
        }

        $data['is_active'] = $request->boolean('is_active');

        $alumni->update($data);

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumni $alumni)
    {
        // Hapus foto dari storage
        if ($alumni->foto) {
            Storage::disk('public')->delete($alumni->foto);
        }

        $alumni->delete();

        return redirect()
            ->route('admin.alumni.index')
            ->with('success', 'Alumni berhasil dihapus.');
    }

    // Toggle is_active via AJAX / inline button
    public function toggleActive(Alumni $alumni)
    {
        $alumni->update(['is_active' => !$alumni->is_active]);

        return response()->json([
            'success'   => true,
            'is_active' => $alumni->is_active,
        ]);
    }

    // Update urutan via SortableJS
    public function reorder(Request $request)
    {
        $request->validate([
            'urutan'   => ['required', 'array'],
            'urutan.*' => ['integer'],
        ]);

        foreach ($request->urutan as $index => $id) {
            Alumni::where('id', $id)->update(['urutan' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}

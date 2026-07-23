<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\JadwalHarianRequest;
use App\Models\JadwalHarian;


class JadwalHarianController extends Controller
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
        $jadwals = JadwalHarian::ordered()->get();
        return view('backend.info-akademik.jadwal-harian.create', compact('jadwals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(JadwalHarianRequest $request)
    {
        $validated = $request->validated();
        $validated['urutan'] = JadwalHarian::max('urutan') + 1;

        JadwalHarian::create($validated);

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
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
    public function edit(JadwalHarian $jadwalHarian)
    {
        $jadwals = JadwalHarian::ordered()->get();
        return view('backend.info-akademik.jadwal-harian.edit', compact('jadwals', 'jadwalHarian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(JadwalHarianRequest $request, JadwalHarian $jadwalHarian)
    {
        $jadwalHarian->update($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalHarian $jadwalHarian)
    {
        $jadwalHarian->delete();

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $index => $id) {
            JadwalHarian::where('id', $id)->update(['urutan' => $index + 1]);
        }
        return response()->json(['success' => true]);
    }
}

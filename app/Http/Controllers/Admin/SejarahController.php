<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sejarah;
use App\Http\Requests\SejarahRequest;


class SejarahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sejarahs = Sejarah::with('images')->get()->keyBy('tipe');

        return view('backend.sejarah.index', [
            'sejarahs' => $sejarahs,
            'tipeLabels' => Sejarah::TIPE_LABELS,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $tipe = $request->query('tipe');

        abort_unless(in_array($tipe, [Sejarah::TIPE_PESANTREN, Sejarah::TIPE_YAYASAN]), 404);
        abort_if(Sejarah::where('tipe', $tipe)->exists(), 404, 'Data sudah ada.');

        return view('backend.sejarah.create', [
            'tipe' => $tipe,
            'label' => Sejarah::TIPE_LABELS[$tipe],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SejarahRequest $request)
    {
        $sejarah = Sejarah::create($request->validated());

        return redirect()
            ->route('admin.sejarah.index')
            ->with('success', "Konten \"{$sejarah->judul}\" berhasil ditambahkan.");
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
    public function edit(Sejarah $sejarah)
    {
        $sejarah->load('images');

        return view('backend.sejarah.edit', compact('sejarah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SejarahRequest $request, Sejarah $sejarah)
    {
        $sejarah->update($request->validated());

        return redirect()
            ->route('admin.sejarah.index')
            ->with('success', "Konten \"{$sejarah->judul}\" berhasil diperbarui.");
       }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

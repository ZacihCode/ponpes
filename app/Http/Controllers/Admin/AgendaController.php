<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Http\Requests\AgendaRequest;

class AgendaController extends Controller
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
        return view('backend.info-akademik.agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AgendaRequest $request)
    {
        Agenda::create($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data agenda berhasil ditambahkan.');
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
    public function edit(Agenda $agenda)
    {
        return view('backend.info-akademik.agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AgendaRequest $request, Agenda $agenda)
    {
        $agenda->update($request->validated());

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data agenda berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()
            ->route('admin.info-akademik.index')
            ->with('success', 'Data agenda berhasil dihapus.');
    }
}

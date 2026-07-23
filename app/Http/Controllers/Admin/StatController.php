<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stat;
use App\Http\Requests\StatRequest;

class StatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stats = Stat::ordered()->get();

        return view('backend.stats.index', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nextOrder = Stat::max('order') + 1;
        return view('backend.stats.create', compact('nextOrder'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StatRequest $request)
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active');

        Stat::create($validated);

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Statistik Berhasil Ditambahkan');
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
    public function edit(Stat $stat)
    {
        return view('backend.stats.edit', compact('stat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StatRequest $request, Stat $stat)
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active');

        $stat->update($validated);

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Statistik Berhasil Diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stat $stat)
    {
        $stat->delete();

        return redirect()
            ->route('admin.stats.index')
            ->with('success', 'Statistik Berhasil Dihapus');
    }

    public function updateOrder(Request $request)
    {
        foreach ($request->order as $position => $id) {
            Stat::where('id', $id)->update(['order' => $position + 1]);
        }
    }
}

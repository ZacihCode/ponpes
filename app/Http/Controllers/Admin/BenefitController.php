<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BenefitRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Benefit;
use App\Models\BenefitImage;



class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Benefit::orderBy('order')->get();

        $images = BenefitImage::all()->keyBy('position');

        $imageCount = BenefitImage::count();

        return view('backend.benefit.index', compact('items', 'images', 'imageCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.benefit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BenefitRequest $request)
    {
        Benefit::create($request->validated());

        return redirect()
            ->route('admin.benefit.index')
            ->with('success', 'Benefit Berhasil Ditambahkan.');
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
    public function edit(Benefit $benefit)
    {
        return view('backend.benefit.edit', compact('benefit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BenefitRequest $request, Benefit $benefit)
    {
        $benefit->update($request->validated());

        return redirect()
            ->route('admin.benefit.index')
            ->with('success', 'Benefit Berhasil Diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Benefit $benefit)
    {
        $benefit->delete();

        return redirect()
            ->route('admin.benefit.index')
            ->with('success', 'Benefit Berhasil Dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OstdaquPosition;
use App\Models\Mudabbir;
use App\Models\KetuaKelas;
use App\Models\KetuaAsrama;

class OrganisasiSantriController extends Controller
{
    public function index()
    {
        $ostdaquPositions = OstdaquPosition::orderBy('tipe', 'asc')
            ->orderBy('urutan')
            ->get();

        $mudabbir = Mudabbir::orderBy('kamar')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kamar');

        $ketuaKelas  = KetuaKelas::orderBy('urutan')->get();
        $ketuaAsrama = KetuaAsrama::orderBy('urutan')->get();

        return view('backend.organisasi-santri.index', compact(
            'ostdaquPositions',
            'mudabbir',
            'ketuaKelas',
            'ketuaAsrama'
        ));
    }
}

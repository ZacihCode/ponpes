<?php

namespace App\Http\Controllers;

use App\Models\OstdaquPosition;
use App\Models\Mudabbir;
use App\Models\KetuaKelas;
use App\Models\KetuaAsrama;

class OrganisasiController extends Controller
{
    public function index()
    {
        $ketuaOstdaqu = OstdaquPosition::aktif()
            ->ketua()
            ->orderBy('urutan')
            ->first();

        $anggotaOstdaqu = OstdaquPosition::aktif()
            ->anggota()
            ->orderBy('urutan')
            ->get();

        $mudabbir = Mudabbir::aktif()
            ->orderBy('kamar')
            ->orderBy('urutan')
            ->get()
            ->groupBy('kamar');

        $ketuaKelas = KetuaKelas::aktif()->orderBy('urutan')->get();

        $ketuaAsrama = KetuaAsrama::aktif()->orderBy('urutan')->get();

        return view('frontend.organisasi', compact(
            'ketuaOstdaqu',
            'anggotaOstdaqu',
            'mudabbir',
            'ketuaKelas',
            'ketuaAsrama'
        ));
    }
}
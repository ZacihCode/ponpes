<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use App\Models\Evaluasi;
use App\Models\JadwalHarian;
use App\Models\Prestasi;
use App\Models\Agenda;

class InfoAkademikController extends Controller
{
    public function index()
    {
        // kurikulum & evaluasi — preview
        $kurikulum_kiri = Kurikulum::where('tipe', 'kolom_kiri')
            ->orderBy('urutan')
            ->get();

        $kurikulum_kanan = Kurikulum::where('tipe', 'kolom_kanan')
            ->orderBy('urutan')
            ->get();

        $evaluasi_kiri = Evaluasi::where('tipe', 'kolom_kiri')
            ->orderBy('urutan')
            ->get();

        $evaluasi_kanan = Evaluasi::where('tipe', 'kolom_kanan')
            ->orderBy('urutan')
            ->get();

        // jadwal, prestasi, agenda — tabel
        $jadwals   = JadwalHarian::orderBy('urutan')->get();
        $prestasis = Prestasi::orderBy('urutan')->get();
        $agendas   = Agenda::orderBy('urutan')->get();

        return view('backend.info-akademik.index', compact(
            'kurikulum_kiri',
            'kurikulum_kanan',
            'evaluasi_kiri',
            'evaluasi_kanan',
            'jadwals',
            'prestasis',
            'agendas'
        ));
    }
}

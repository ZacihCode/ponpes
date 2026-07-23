<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::where('is_active', true)
            ->orderBy('urutan')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('frontend.galeri', compact('galeris'));
    }
}

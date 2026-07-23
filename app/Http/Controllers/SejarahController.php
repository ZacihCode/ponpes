<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sejarah;

class SejarahController extends Controller
{
    public function index()
    {
        $sejarahs = Sejarah::with('images')->get()->keyBy('tipe');

        return view('frontend.profil.sejarah', compact('sejarahs'));
    }
}

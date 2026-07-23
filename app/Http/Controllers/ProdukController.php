<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::active()->order()->get();

        return view('frontend.produk', compact('produks'));
    }
}

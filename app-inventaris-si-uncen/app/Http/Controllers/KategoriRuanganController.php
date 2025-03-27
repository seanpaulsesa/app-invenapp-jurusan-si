<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriRuanganController extends Controller
{
    public function index()
    {
        return view('kategori-ruangan.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBarang;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $datas = KategoriBarang::all();

        return view('kategori-barang.index', compact('datas'));
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $datas = Barang::all();

        return view('barang.index', compact('datas'));
    }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;
use App\Models\Ruangan;
use App\Models\KategoriRuangan;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;

class StatistikController extends Controller
{
    public $pageIcon;
    public $contentTitle;

    public function __construct()
    {
        $this->pageIcon = "fas fa-fw fa-chart-pie";
        $this->contentTitle = "Statistik";
    }

    // index
    public function index()
    {
        // mengambil semua data barang untuk ditampilkan pada tabel barang
        // $datas = Barang::orderBy('nama','asc')->get();


        return view('statistik.index', [
            'pageTitle' => Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Melihat ' . Str::lower($this->contentTitle) . ': barang dan ruangan.',
            'pageIcon' => $this->pageIcon,
            // 'datas' => $datas,
        ]);

    }

    // API UNTUK MENAMPILKAN CHART BARANG PER KATEGORI
    public function chartBarangPerKategori()
    {
        $kategori = KategoriBarang::withCount('barang')->get();
        $data = [];
        foreach ($kategori as $k) {
            $data[] = [
                'name' => $k->nama_kategori,
                'y' => (int)$k->barang_count,
            ];
        }
        return response()->json($data);
    }

    // API UNTUK MENAMPILKAN CHART RUANGAN PER KATEGORI
    public function chartRuanganPerKategori()
    {
        $kategori = KategoriRuangan::withCount('ruangan')->get();
        $data = [];
        foreach ($kategori as $k) {
            $data[] = [
                'name' => $k->nama_kategori,
                'y' => (int)$k->ruangan_count,
            ];
        }
        return response()->json($data);
    }


}

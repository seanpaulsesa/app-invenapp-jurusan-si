<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Support\Str;

use Illuminate\Validation\ValidationException;

class BerandaController extends Controller
{
    public $pageIcon;
    public $contentTitle;

    public function __construct()
    {
        $this->pageIcon = "fas fa-fw fa-tachometer-alt";
        $this->contentTitle = "Beranda";
    }
    // index
    public function index()
    {
        // mengambil semua data barang untuk ditampilkan pada tabel barang
        // $datas = Barang::orderBy('nama','asc')->get();


        return view('beranda', [
            'pageTitle' => Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Mengatur semua data ' . Str::lower($this->contentTitle) . ': buat baru, tampilkan detail, ubah data, arsipkan, hapus permanen, dan pulihkan.',
            'pageIcon' => $this->pageIcon,
            // 'datas' => $datas,
        ]);

    }


}

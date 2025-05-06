<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBarang;
use Illuminate\Support\Str;

class KategoriBarangController extends Controller
{
    public $pageIcon;
    public $contentTitle;

    public function __construct()
    {
        $this->pageIcon = "fas fa-folder";
        $this->contentTitle = "Kategori Barang";
    }

    // index
    public function index()
    {
        $datas = KategoriBarang::orderBy('nama_kategori','asc')->get();// Halaman Kategori Barang

        return view('kategori-barang.index', [
            'pageTitle' => Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Mengatur semua data ' . Str::lower($this->contentTitle) . ': buat baru, tampilkan detail, ubah data, arsipkan, hapus permanen, dan pulihkan.',
            'pageIcon' => $this->pageIcon,
            'datas' => $datas,
            'i' => (request()->input('page', 1) - 1) * 5,
        ]);
    }

    // create
    public function create()
    {
        return view('kategori-barang.form', [
            'pageTitle' => 'Tambah ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Formulir tambah data ' . Str::lower($this->contentTitle),
            'pageIcon' => $this->pageIcon,
        ]);


    }// store
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_kategori' => 'required',
                'keterangan' => 'nullable',
            ]);
        
            // Simpan data barang terlebih dahulu tanpa gambar
            $barang = KategoriBarang::create($request->only(['nama_kategori', 'keterangan']));
        
            // Redirect dengan pesan sukses
            return redirect()->route('kategori-barang')->with('success', Str::ucfirst($this->contentTitle) . ' berhasil ditambahkan');

        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menyimpan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $data = KategoriBarang::findOrFail($id);

        return view('kategori-barang.show', [
            'pageTitle' => 'Detail ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Detail informasi dari ' . Str::lower($this->contentTitle),
            'data' => $data,
            'pageIcon' => $this->pageIcon,
        ]);
    }

    public function edit($id)
    {
        $data = KategoriBarang::findOrFail($id);

        return view('kategori-barang.form', [
            'pageTitle' => 'Edit ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Edit informasi dari ' . Str::lower($this->contentTitle),
            'data' => $data,
            'pageIcon' => $this->pageIcon,
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'nama_kategori' => 'required',
                'keterangan' => 'nullable',
            ]);
        
            // Ambil data barang berdasarkan ID
            $barang = KategoriBarang::findOrFail($id);
        
            // Ambil data yang diperbolehkan untuk update
            $updateData = $request->only(['nama_kategori', 'keterangan']);
        
            // Update data barang di database
            $barang->update($updateData);
        
            // Redirect dengan pesan sukses
            return redirect()->back()->with('success', Str::ucfirst($this->contentTitle) . ' berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal memperbarui
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

    // destroy
    public function destroy($id)
    {
        try {
            // Temukan data kategori berdasarkan ID
            $data = KategoriBarang::findOrFail($id);

            // Hapus data secara permanen
            $data->delete();

            return redirect()->back()->with('success', Str::ucfirst($this->contentTitle) . ' berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus '. Str::lower($this->contentTitle) .': ' . $e->getMessage());
        }
    }


}

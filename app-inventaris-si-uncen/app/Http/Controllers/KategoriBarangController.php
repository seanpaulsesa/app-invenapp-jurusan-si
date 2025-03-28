<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBarang;

class KategoriBarangController extends Controller
{
    // index
    public function index()
    {
        $datas = KategoriBarang::all();// Halaman Kategori Barang

        $pageTitle = "Kategori Barang";
        $pageDescription = "Lihat dan kelola daftar kategori barang. Gunakan fitur pencarian dan filter untuk menemukan kategori dengan mudah.";

        return view('kategori-barang.index', compact('pageTitle', 'pageDescription', 'datas'));
    }

    // create
    public function create()
    {
        // Judul dan deskripsi halaman
        $pageTitle = "Tambah Kategori Barang";
        $pageDescription = "Silakan tambahkan kategori barang baru dengan mengisi formulir di bawah ini. Pastikan semua informasi yang dimasukkan sudah benar sebelum disimpan.";

        return view('kategori-barang.form', compact('pageTitle', 'pageDescription'));


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
            return redirect()->route('kategori-barang')->with('success', 'Kategori barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menyimpan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    

    // edit
    public function edit($id)
    {
        // mengambil data kategori barang berdasarkan id yang dikirimkan di url
        $data = KategoriBarang::findOrFail($id);

        // Halaman Ubah Kategori Barang
        $pageTitle = "Ubah Kategori Barang";
        $pageDescription = "Edit informasi kategori barang yang sudah ada. Perbarui nama atau deskripsi sesuai kebutuhan.";

        return view('kategori-barang.form', compact('pageTitle','pageDescription','data'));
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
            return redirect()->route('kategori-barang.edit', $id)->with('success', 'Data barang berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal memperbarui
            return redirect()->route('kategori-barang.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // show
    public function show($id)
    {
        // mengambil data kategori barang berdasarkan id yang dikirimkan di url
        $data = KategoriBarang::findOrFail($id);

        // Halaman Detail Kategori Barang
        $pageTitle = "Detail Kategori Barang";
        $pageDescription = "Lihat informasi lengkap tentang kategori barang, termasuk daftar barang yang termasuk dalam kategori ini.";

        return view('kategori-barang.show', compact('pageTitle','pageDescription','data'));
    }

    // destroy
    public function destroy($id)
    {
        try {
            // Temukan data kategori berdasarkan ID
            $data = KategoriBarang::findOrFail($id);

            // Hapus data secara permanen
            $data->delete();

            return redirect()->route('kategori-barang')->with('success', 'Kategori Barang berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->route('kategori-barang')->with('error', 'Gagal menghapus Kategori Barang: ' . $e->getMessage());
        }
    }


}

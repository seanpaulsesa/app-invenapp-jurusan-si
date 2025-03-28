<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;



class BarangController extends Controller
{
    // index
    public function index()
    {
        // mengambil semua data barang untuk ditampilkan pada tabel barang
        $datas = Barang::all();

        // mengambil semua data kategori barang untuk ditampilkan pada dropdown filter kategori barang
        $kategoriBarang = KategoriBarang::all();

        // judul dan deskripsi halaman
        $pageTitle = "Barang";
        $pageDescription = "Lihat dan kelola daftar barang yang tersedia. Gunakan fitur pencarian dan filter kategori untuk menemukan barang dengan mudah.";

        return view('barang.index', compact('pageTitle','pageDescription','datas', 'kategoriBarang'));
    }

    // create
    public function create()
    {
        // mengambil semua data kategori barang untuk ditampilkan pada dropdown/select kategori barang
        $kategoriBarang = KategoriBarang::all();

        // judul dan deskripsi halaman
        $pageTitle = "Tambah Barang";
        $pageDescription = "Silakan tambahkan data barang baru dengan mengisi formulir di bawah ini. Pastikan semua informasi yang dimasukkan sudah benar sebelum disimpan.";

        return view('barang.form', compact('pageTitle','pageDescription','kategoriBarang'));
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required',
                'kategori_id' => 'required',
                'keterangan' => 'nullable',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            ]);
        
            // Simpan data barang terlebih dahulu tanpa gambar
            $barang = Barang::create($request->only(['nama', 'kategori_id', 'keterangan']));
        
            // Cek apakah ada file gambar yang diunggah
            if ($request->hasFile('gambar')) {
                // Buat folder berdasarkan ID barang
                $folderPath = 'uploads/barang/' . $barang->id;
        
                // Simpan gambar ke folder yang sesuai
                $gambarPath = $request->file('gambar')->store($folderPath, 'public');
        
                // Simpan path gambar ke database
                $barang->update(['gambar' => $gambarPath]);
            }
        
            // Redirect dengan pesan sukses
            return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menyimpan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // edit
    public function edit($id)
    {
        // mengambil data barang berdasarkan id yang dikirimkan di url
        $data = Barang::findOrFail($id);

        // mengambil semua data kategori barang untuk ditampilkan pada dropdown/select kategori barang
        $kategoriBarang = KategoriBarang::all();

        // judul dan deskripsi halaman
        $pageTitle = "Ubah Barang";
        $pageDescription = "Perbarui informasi barang sesuai kebutuhan. Pastikan perubahan yang dilakukan sudah sesuai sebelum menyimpan data.";

        return view('barang.form', compact('pageTitle','pageDescription','data', 'kategoriBarang'));
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required',
                'kategori_id' => 'required',
                'keterangan' => 'nullable',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            ]);
        
            // Ambil data barang berdasarkan ID
            $barang = Barang::findOrFail($id);
        
            // Ambil data yang diperbolehkan untuk update
            $updateData = $request->only(['nama', 'kategori_id', 'keterangan']);
        
            // Cek apakah ada file gambar baru yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($barang->gambar) {
                    Storage::disk('public')->delete($barang->gambar);
                }
        
                // Tentukan folder berdasarkan ID barang
                $folderPath = 'uploads/barang/' . $barang->id;
        
                // Simpan gambar baru ke dalam folder barang/{id}
                $gambarPath = $request->file('gambar')->store($folderPath, 'public');
        
                // Simpan path gambar ke database
                $updateData['gambar'] = $gambarPath;
            }
        
            // Update data barang di database
            $barang->update($updateData);
        
            // Redirect dengan pesan sukses
            return redirect()->route('barang.edit', $id)->with('success', 'Data barang berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal memperbarui
            return redirect()->route('barang.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // show
    public function show($id)
    {
        // mengambil data barang berdasarkan id yang dikirimkan di url
        $data = Barang::findOrFail($id);

        // judul dan deskripsi halaman
        $pageTitle = "Detail Barang";
        $pageDescription = "Lihat informasi lengkap mengenai barang yang dipilih. Pastikan data yang ditampilkan sesuai dengan kebutuhan Anda.";

        return view('barang.show', compact('pageTitle','pageDescription','data'));
    }

    // destroy
    public function destroy($id)
    {
        try {
            // Temukan data barang berdasarkan ID
            $data = Barang::findOrFail($id);

            // Hapus gambar dari storage jika ada
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }

            // Hapus data secara permanen
            $data->delete();

            return redirect()->route('barang')->with('success', 'Barang berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->route('barang')->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }


}

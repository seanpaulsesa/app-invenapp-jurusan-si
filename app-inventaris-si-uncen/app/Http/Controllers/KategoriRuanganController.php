<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriRuangan;

use Illuminate\Validation\ValidationException;

class KategoriRuanganController extends Controller
{
    // index
    public function index()
    {
        $datas = KategoriRuangan::all();// Halaman Kategori Ruangan

        $pageTitle = "Kategori Ruangan";
        $pageDescription = "Lihat dan kelola daftar kategori ruangan. Gunakan fitur pencarian dan filter untuk menemukan kategori dengan mudah.";

        return view('kategori-ruangan.index', compact('pageTitle', 'pageDescription', 'datas'));
    }

    // create
    public function create()
    {
        // Judul dan deskripsi halaman
        $pageTitle = "Tambah Kategori Ruangan";
        $pageDescription = "Silakan tambahkan kategori ruangan baru dengan mengisi formulir di bawah ini. Pastikan semua informasi yang dimasukkan sudah benar sebelum disimpan.";

        return view('kategori-ruangan.form', compact('pageTitle', 'pageDescription'));
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validated = $request->validate([
                'nama_kategori' => 'required|string|max:100|unique:kategori_ruangan,nama_kategori',
                'keterangan' => 'nullable|string|max:255',
            ]);

            // Simpan data ke database
            KategoriRuangan::create($validated);

            // Redirect dengan pesan sukses
            return redirect()->route('kategori-ruangan')->with('success', 'Kategori ruangan berhasil ditambahkan');

        } catch (ValidationException $e) {
            // Jika validasi gagal, kembalikan dengan error dan input sebelumnya
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Tangani error umum
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // edit
    public function edit($id)
    {
        // mengambil data kategori ruangan berdasarkan id yang dikirimkan di url
        $data = KategoriRuangan::findOrFail($id);

        // Halaman Ubah Kategori Ruangan
        $pageTitle = "Ubah Kategori Ruangan";
        $pageDescription = "Edit informasi kategori ruangan yang sudah ada. Perbarui nama atau deskripsi sesuai kebutuhan.";

        return view('kategori-ruangan.form', compact('pageTitle','pageDescription','data'));
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // Ambil data ruangan berdasarkan ID
            $ruangan = KategoriRuangan::findOrFail($id);

            // Validasi input
            $request->validate([
                'nama_kategori' => 'required|string|max:100|unique:kategori_ruangan,nama_kategori,' . $id,
                'keterangan' => 'nullable|string|max:255',
            ]);

            // Ambil data yang diperbolehkan untuk update
            $updateData = $request->only(['nama_kategori', 'keterangan']);

            // Update data ruangan di database
            $ruangan->update($updateData);

            // Redirect dengan pesan sukses
            return redirect()->route('kategori-ruangan.edit', $id)->with('success', 'Data ruangan berhasil diperbarui');

        } catch (ValidationException $e) {
            // Jika validasi gagal
            return redirect()->route('kategori-ruangan.edit', $id)
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal memperbarui
            return redirect()->route('kategori-ruangan.edit', $id)
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // show
    public function show($id)
    {
        // mengambil data kategori ruangan berdasarkan id yang dikirimkan di url
        $data = KategoriRuangan::findOrFail($id);

        // Halaman Detail Kategori Ruangan
        $pageTitle = "Detail Kategori Ruangan";
        $pageDescription = "Lihat informasi lengkap tentang kategori ruangan, termasuk daftar ruangan yang termasuk dalam kategori ini.";

        return view('kategori-ruangan.show', compact('pageTitle','pageDescription','data'));
    }

    // destroy
    public function destroy($id)
    {
        try {
            // Temukan data kategori berdasarkan ID
            $data = KategoriRuangan::findOrFail($id);

            // Hapus data secara permanen
            $data->delete();

            return redirect()->route('kategori-ruangan')->with('success', 'Kategori Ruangan berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->route('kategori-ruangan')->with('error', 'Gagal menghapus Kategori Ruangan: ' . $e->getMessage());
        }
    }
}

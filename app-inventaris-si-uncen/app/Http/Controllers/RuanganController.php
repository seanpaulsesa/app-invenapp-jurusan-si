<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\KategoriRuangan;

use Illuminate\Validation\ValidationException;

class RuanganController extends Controller
{
    // index
    public function index()
    {
        $datas = Ruangan::all();
        $kategoriRuangan = KategoriRuangan::all();
        $pageTitle = "Ruangan";
        $pageDescription = "Lihat dan kelola daftar ruangan yang tersedia. Gunakan fitur pencarian dan filter kategori untuk menemukan ruangan dengan mudah.";

        return view('ruangan.index', compact('pageTitle','pageDescription','datas', 'kategoriRuangan'));
    }

    // create
    public function create()
    {
        $kategoriRuangan = KategoriRuangan::all();
        $pageTitle = "Tambah Ruangan";
        $pageDescription = "Silakan tambahkan data ruangan baru dengan mengisi formulir di bawah ini. Pastikan semua informasi yang dimasukkan sudah benar sebelum disimpan.";

        return view('ruangan.form', compact('pageTitle','pageDescription','kategoriRuangan'));
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:kategori_ruangan,id',
                'keterangan' => 'nullable|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Simpan data awal (tanpa gambar)
            $ruangan = Ruangan::create($request->only(['nama', 'kategori_id', 'keterangan']));

            // Proses upload gambar jika ada
            if ($request->hasFile('gambar')) {
                $folderPath = 'uploads/ruangan/' . $ruangan->id;
                $gambarPath = $request->file('gambar')->store($folderPath, 'public');
                $ruangan->update(['gambar' => $gambarPath]);
            }

            return redirect()->route('ruangan')->with('success', 'Ruangan berhasil ditambahkan');

        } catch (ValidationException $e) {
            // Jika validasi gagal
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Tangani error lain
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // edit
    public function edit($id)
    {
        $data = Ruangan::findOrFail($id);
        $kategoriRuangan = KategoriRuangan::all();
        $pageTitle = "Ubah Ruangan";
        $pageDescription = "Perbarui informasi ruangan sesuai kebutuhan. Pastikan perubahan yang dilakukan sudah sesuai sebelum menyimpan data.";

        return view('ruangan.form', compact('pageTitle','pageDescription','data', 'kategoriRuangan'));
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // Validasi input dengan aturan lengkap
            $request->validate([
                'nama' => 'required|string|max:100',
                'kategori_id' => 'required|exists:kategori_ruangan,id',
                'keterangan' => 'nullable|string|max:255',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Cari data ruangan berdasarkan ID
            $ruangan = Ruangan::findOrFail($id);

            // Ambil data yang boleh diupdate
            $updateData = $request->only(['nama', 'kategori_id', 'keterangan']);

            // Jika ada gambar baru, hapus gambar lama dan simpan gambar baru
            if ($request->hasFile('gambar')) {
                if ($ruangan->gambar) {
                    Storage::disk('public')->delete($ruangan->gambar);
                }
                $folderPath = 'uploads/ruangan/' . $ruangan->id;
                $gambarPath = $request->file('gambar')->store($folderPath, 'public');
                $updateData['gambar'] = $gambarPath;
            }

            // Update data ruangan
            $ruangan->update($updateData);

            return redirect()->route('ruangan.edit', $id)->with('success', 'Data ruangan berhasil diperbarui');

        } catch (ValidationException $e) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error dan input lama
            return redirect()->route('ruangan.edit', $id)
                            ->withErrors($e->validator)
                            ->withInput();

        } catch (\Exception $e) {
            // Tangani error lainnya
            return redirect()->route('ruangan.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    // show
    public function show($id)
    {
        $data = Ruangan::findOrFail($id);
        $pageTitle = "Detail Ruangan";
        $pageDescription = "Lihat informasi lengkap mengenai ruangan yang dipilih. Pastikan data yang ditampilkan sesuai dengan kebutuhan Anda.";

        return view('ruangan.show', compact('pageTitle','pageDescription','data'));
    }

    // destroy
    public function destroy($id)
    {
        try {
            $data = Ruangan::findOrFail($id);
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->delete();
            return redirect()->route('ruangan')->with('success', 'Ruangan berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->route('ruangan')->with('error', 'Gagal menghapus ruangan: ' . $e->getMessage());
        }
    }
}

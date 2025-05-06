<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public $pageIcon;
    public $contentTitle;

    public function __construct()
    {
        $this->pageIcon = "fas fa-box";
        $this->contentTitle = "Barang";
    }
    // index
    public function index()
    {
        // mengambil semua data barang untuk ditampilkan pada tabel barang
        $datas = Barang::orderBy('nama','asc')->get();

        // mengambil semua data kategori barang untuk ditampilkan pada dropdown filter kategori barang
        $kategoriBarang = KategoriBarang::all();

        return view('barang.index', [
            'pageTitle' => Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Mengatur semua data ' . Str::lower($this->contentTitle) . ': buat baru, tampilkan detail, ubah data, arsipkan, hapus permanen, dan pulihkan.',
            'pageIcon' => $this->pageIcon,
            'kategoriBarang' => $kategoriBarang,
            'datas' => $datas,
            'i' => (request()->input('page', 1) - 1) * 5,
        ]);

    }

    // create
    public function create()
    {
        // mengambil semua data kategori barang untuk ditampilkan pada dropdown/select kategori barang
        $kategoriBarang = KategoriBarang::all();

        return view('barang.form', [
            'pageTitle' => 'Tambah ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Formulir tambah data ' . Str::lower($this->contentTitle),
            'kategoriBarang' => $kategoriBarang,
            'pageIcon' => $this->pageIcon,
        ]);
    }

    // store
    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategori_barang,id',
                'satuan' => 'nullable|string|max:50',
                'jumlah_satuan' => 'nullable|integer|min:1',
                'satuan_harga' => 'nullable|numeric|min:0',
                'keterangan' => 'nullable|string|max:500',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
            ]);
        
            // Simpan semua data validasi ke dalam variabel $barang
            $barang = Barang::create($request->all());
        
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
            return redirect()->route('barang')->with('success', Str::ucfirst($this->contentTitle) . ' berhasil ditambahkan');

        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menyimpan
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

        return view('barang.form', [
            'pageTitle' => 'Edit ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Edit informasi dari ' . Str::lower($this->contentTitle),
            'data' => $data,
            'pageIcon' => $this->pageIcon,
        ]);
    }

    // edit
    public function edit($id)
    {
        // mengambil data barang berdasarkan id yang dikirimkan di url
        $data = Barang::findOrFail($id);

        // mengambil semua data kategori barang untuk ditampilkan pada dropdown/select kategori barang
        $kategoriBarang = KategoriBarang::all();

        return view('barang.form', [
            'pageTitle' => 'Edit ' . Str::ucfirst($this->contentTitle),
            'pageDescription' => 'Edit informasi dari ' . Str::lower($this->contentTitle),
            'data' => $data,
            'kategoriBarang' => $kategoriBarang,
            'pageIcon' => $this->pageIcon,
        ]);
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required|string|max:255',
                'kategori_id' => 'required|exists:kategori_barang,id',
                'satuan' => 'nullable|string|max:50',
                'harga_satuan' => 'nullable|numeric|min:0',
                'jumlah_satuan' => 'nullable|integer|min:1',
                'jumlah_harga' => 'nullable',
                'keterangan' => 'nullable|string|max:500',
                'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Ambil data barang berdasarkan ID
            $barang = Barang::findOrFail($id);

            
            // Ambil data yang diperbolehkan untuk update
            $updateData = $request->all();
            
            // Hitung jumlah_harga jika jumlah_satuan dan satuan_harga tersedia
            if ($request->harga_satuan && $request->jumlah_satuan) {
                $jumlahHarga = $request->harga_satuan * $request->jumlah_satuan;
                $updateData['jumlah_harga'] = $jumlahHarga;
            }


            // Cek apakah ada file gambar baru yang diunggah
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($barang->gambar) {
                    Storage::disk('public')->delete($barang->gambar);
                }

                // Tentukan folder berdasarkan ID barang
                $folderPath = 'uploads/barang/' . $barang->id;

                // Simpan gambar baru ke dalam folder
                $gambarPath = $request->file('gambar')->store($folderPath, 'public');

                // Simpan path gambar ke database
                $updateData['gambar'] = $gambarPath;
            }

            // Update data barang di database
            $barang->update($updateData);

            return redirect()->back()->with('success', Str::ucfirst($this->contentTitle) . ' berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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

            return redirect()->back()->with('success', Str::ucfirst($this->contentTitle) . ' berhasil dihapus secara permanen dari database');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus '. Str::lower($this->contentTitle) .': ' . $e->getMessage());
        }
    }


}

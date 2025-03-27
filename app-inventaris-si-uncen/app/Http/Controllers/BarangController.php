<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\KategoriBarang;

class BarangController extends Controller
{
    public function index()
    {
        $datas = Barang::all();
        $kategoriBarang = KategoriBarang::all();

        return view('barang.index', compact('datas', 'kategoriBarang'));
    }

    public function create()
    {
        $kategoriBarang = KategoriBarang::all();
        return view('barang.form', compact('kategoriBarang'));
    }

    public function store(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required',
                'kategori_id' => 'required',
                'keterangan' => 'nullable',
            ]);

            // Simpan data barang
            Barang::create($request->all());

            // Redirect dengan pesan sukses
            return redirect()->route('barang')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menyimpan
            return redirect()->route('barang')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data = Barang::findOrFail($id);
        $kategoriBarang = KategoriBarang::all();
        return view('barang.form', compact('data', 'kategoriBarang'));
    }

    public function update(Request $request, $id)
    {
        try {
            // Validasi input
            $request->validate([
                'nama' => 'required',
                'kategori_id' => 'required',
                'keterangan' => 'nullable',
            ]);

            // Update data barang
            $data = Barang::findOrFail($id);
            $data->update($request->all());

            // Redirect dengan pesan sukses
            return redirect()->route('barang.edit', $id)->with('success', 'Data barang berhasil diperbarui');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal memperbarui
            return redirect()->route('barang.edit', $id)->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function destroy($id)
    {
        try {
            // Hapus data barang
            $data = Barang::findOrFail($id);
            $data->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika gagal menghapus
            return redirect()->route('barang')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $data = Barang::findOrFail($id);
        return view('barang.show', compact('data'));
    }

 

    public function filter(Request $request)
    {
        $kategori_id = $request->input('kategori_id');
        $datas = Barang::where('kategori_id', $kategori_id)->get();
        return view('barang.index', compact('datas'));
    }
    
    public function export()
    {
        $datas = Barang::all();
        $filename = 'barang_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['ID', 'Nama', 'Kategori ID', 'Keterangan']);
        foreach ($datas as $data) {
            fputcsv($handle, [$data->id, $data->nama, $data->kategori_id, $data->keterangan]);
        }
        fclose($handle);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        exit;
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $handle = fopen($file, 'r');
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            Barang::create([
                'nama' => $data[1],
                'kategori_id' => $data[2],
                'keterangan' => $data[3],
            ]);
        }
        fclose($handle);

        return redirect()->route('barang')->with('success', 'Barang berhasil diimpor');
    }
    public function print()
    {
        $datas = Barang::all();
        return view('barang.print', compact('datas'));
    }
    public function pdf()
    {
        $datas = Barang::all();
        $pdf = \PDF::loadView('barang.pdf', compact('datas'));
        return $pdf->download('barang.pdf');
    }
    public function excel()
    {
        $datas = Barang::all();
        return \Excel::download(new \App\Exports\BarangExport($datas), 'barang.xlsx');
    }
    public function importView()
    {
        return view('barang.import');
    }
    public function exportView()
    {
        return view('barang.export');
    }
    public function printView()
    {
        return view('barang.print');
    }
    public function pdfView()
    {
        return view('barang.pdf');
    }
    public function excelView()
    {
        return view('barang.excel');
    }
    public function searchView()
    {
        return view('barang.search');
    }
    public function filterView()
    {
        return view('barang.filter');
    }
    


}

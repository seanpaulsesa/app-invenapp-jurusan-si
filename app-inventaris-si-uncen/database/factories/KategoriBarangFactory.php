<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KategoriBarang;

class KategoriBarangFactory extends Factory
{
    protected $model = KategoriBarang::class;

    public function definition()
    {
        static $id = 1;

        $kategori = [
            ['id' => 1, 'nama_kategori' => 'Elektronik', 'keterangan' => 'Barang-barang elektronik untuk kebutuhan akademik dan perkantoran.'],
            ['id' => 2, 'nama_kategori' => 'Furniture', 'keterangan' => 'Perabotan untuk ruang kelas, kantor, dan asrama.'],
            ['id' => 3, 'nama_kategori' => 'Aksesoris Komputer', 'keterangan' => 'Peralatan tambahan untuk komputer dan perangkat IT.'],
            ['id' => 4, 'nama_kategori' => 'Buku & Referensi', 'keterangan' => 'Buku akademik dan referensi untuk mahasiswa dan dosen.'],
            ['id' => 5, 'nama_kategori' => 'Peralatan Laboratorium', 'keterangan' => 'Alat-alat laboratorium untuk penelitian dan praktikum.'],
            ['id' => 6, 'nama_kategori' => 'Peralatan Makan & Minum', 'keterangan' => 'Peralatan seperti botol minum, tempat makan, dan lainnya.'],
            ['id' => 7, 'nama_kategori' => 'Pakaian & Atribut Kampus', 'keterangan' => 'Seragam, jas almamater, dan perlengkapan kampus lainnya.'],
            ['id' => 8, 'nama_kategori' => 'Keamanan & Kesehatan', 'keterangan' => 'Alat keselamatan dan kesehatan seperti helm dan P3K.'],
            ['id' => 9, 'nama_kategori' => 'Peralatan Musik & Seni', 'keterangan' => 'Instrumen musik dan alat seni untuk kegiatan ekstrakurikuler.'],
            ['id' => 10, 'nama_kategori' => 'Aksesori Kendaraan', 'keterangan' => 'Aksesori kendaraan seperti helm dan sarung tangan.'],
        ];

        $data = $kategori[$id - 1] ?? end($kategori);
        $id++;

        return $data;
    }
}

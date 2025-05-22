<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriRuangan;

class KategoriRuanganSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            [
                'nama_kategori' => 'Ruang Rapat',
                'keterangan' => 'Kategori untuk ruang yang digunakan sebagai ruang rapat dan diskusi.'
            ],
            [
                'nama_kategori' => 'Ruang Kelas',
                'keterangan' => 'Kategori untuk ruang yang digunakan sebagai ruang belajar atau kelas.'
            ],
            [
                'nama_kategori' => 'Ruang Laboratorium',
                'keterangan' => 'Kategori untuk ruang praktikum dan penelitian laboratorium.'
            ],
            [
                'nama_kategori' => 'Ruang Perpustakaan',
                'keterangan' => 'Kategori untuk ruang yang digunakan sebagai perpustakaan.'
            ],
            [
                'nama_kategori' => 'Ruang Kantor',
                'keterangan' => 'Kategori untuk ruang kerja kantor atau administrasi.'
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriRuangan::create($kategori);
        }
    }
}

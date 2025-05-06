<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            [
                'nama_kategori' => 'Alat Tulis',
                'keterangan' => 'Barang kebutuhan tulis-menulis seperti pensil, pulpen, penghapus, dll.'
            ],
            [
                'nama_kategori' => 'ATK (Alat Tulis Kantor)',
                'keterangan' => 'Barang-barang kantor seperti map, stapler, paper clip, dll.'
            ],
            [
                'nama_kategori' => 'Elektronik',
                'keterangan' => 'Perangkat elektronik seperti proyektor, printer, scanner, dll.'
            ],
            [
                'nama_kategori' => 'Laboratorium',
                'keterangan' => 'Peralatan untuk keperluan praktikum laboratorium.'
            ],
            [
                'nama_kategori' => 'Kebersihan',
                'keterangan' => 'Perlengkapan kebersihan seperti sapu, pel, ember, dan cairan pembersih.'
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriBarang::create($kategori);
        }
    }
}

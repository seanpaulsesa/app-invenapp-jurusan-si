<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ruangan;

class RuanganSeeder extends Seeder
{
    public function run()
    {
        $ruangans = [
            [
                'nama' => 'Ruang Rapat A',
                'gambar' => 'seeder-images/ruangan/ruang-rapat-a.jpg',
                'kategori_id' => 1,
                'keterangan' => 'Ruang rapat untuk 20 orang',
            ],
            [
                'nama' => 'Ruang Kelas 101',
                'gambar' => 'seeder-images/ruangan/ruang-kelas-101.jpg',
                'kategori_id' => 2,
                'keterangan' => 'Ruang kelas dengan kapasitas 40 siswa',
            ],
            [
                'nama' => 'Ruang Server',
                'gambar' => 'seeder-images/ruangan/ruang-server.jpg',
                'kategori_id' => 3,
                'keterangan' => 'Ruang khusus server dan perangkat jaringan',
            ],
            [
                'nama' => 'Ruang Perpustakaan',
                'gambar' => NULL,
                'kategori_id' => 4,
                'keterangan' => 'Ruang baca dengan koleksi buku lengkap',
            ],
            [
                'nama' => 'Ruang Kepala Sekolah',
                'gambar' => NULL,
                'kategori_id' => 5,
                'keterangan' => 'Ruang kerja kepala sekolah',
            ],
        ];

        foreach ($ruangans as $ruangan) {
            Ruangan::create($ruangan);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $barangs = [
            [
                'nama' => 'Pensil 2B',
                'gambar' => 'seeder-images/barang/pensil-2b.jpg',
                'satuan' => 'buah',
                'harga_satuan' => '2000',
                'jumlah_satuan' => '100',
                'jumlah_harga' => '200000',
                'kategori_id' => 1,
                'keterangan' => 'Pensil untuk ujian'
            ],
            [
                'nama' => 'Buku Tulis',
                'gambar' => 'seeder-images/barang/buku-tulis.jpg',
                'satuan' => 'pak',
                'harga_satuan' => '15000',
                'jumlah_satuan' => '50',
                'jumlah_harga' => '750000',
                'kategori_id' => 2,
                'keterangan' => 'Buku tulis 40 lembar'
            ],
            [
                'nama' => 'Spidol Hitam',
                'gambar' => 'seeder-images/barang/spidol-hitam.jpg',
                'satuan' => 'buah',
                'harga_satuan' => '5000',
                'jumlah_satuan' => '60',
                'jumlah_harga' => '300000',
                'kategori_id' => 1,
                'keterangan' => 'Spidol permanent'
            ],
            [
                'nama' => 'Map Folder',
                'gambar' => NULL,
                'satuan' => 'pak',
                'harga_satuan' => '10000',
                'jumlah_satuan' => '40',
                'jumlah_harga' => '400000',
                'kategori_id' => 2,
                'keterangan' => 'Map plastik warna-warni'
            ],
            [
                'nama' => 'Penghapus',
                'gambar' => NULL,
                'satuan' => 'buah',
                'harga_satuan' => '1500',
                'jumlah_satuan' => '120',
                'jumlah_harga' => '180000',
                'kategori_id' => 1,
                'keterangan' => 'Penghapus pensil putih'
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}

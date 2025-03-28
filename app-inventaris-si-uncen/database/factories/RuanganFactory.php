<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ruangan;
use App\Models\KategoriRuangan;

class RuanganFactory extends Factory
{
    protected $model = Ruangan::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->randomElement([
            'Ruang Kelas A101', 
            'Laboratorium Komputer 1', 
            'Ruang Server', 
            'Ruang Rapat Fakultas', 
            'Perpustakaan Sistem Informasi', 
            'Ruang Startup & Inkubator', 
            'Ruang Dosen', 
            'Ruang Seminar IT', 
            'Ruang Asistensi Mahasiswa', 
            'Ruang Data Center'
        ]),
            'gambar' => $this->faker->randomElement([
                '',
            ]),
            'kategori_id' => KategoriRuangan::factory(), // Relasi otomatis dengan kategori
            'keterangan' => $this->faker->sentence(),
        ];
    }
}

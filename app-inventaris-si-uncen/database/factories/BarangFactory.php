<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Barang;
use App\Models\KategoriBarang;

class BarangFactory extends Factory
{
    protected $model = Barang::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->word(),
            'kategori_id' => KategoriBarang::factory(), // Relasi otomatis dengan kategori
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
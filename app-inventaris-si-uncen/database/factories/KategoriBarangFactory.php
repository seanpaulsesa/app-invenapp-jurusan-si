<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KategoriBarang;

class KategoriBarangFactory extends Factory
{
    protected $model = KategoriBarang::class;

    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->randomElement(['Elektronik', 'Furniture', 'Aksesoris Komputer']),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}
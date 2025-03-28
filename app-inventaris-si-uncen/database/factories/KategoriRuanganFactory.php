<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KategoriRuangan;

class KategoriRuanganFactory extends Factory
{
    protected $model = KategoriRuangan::class;

    public function definition()
    {
        return [
            'nama_kategori' => $this->faker->unique()->word(),
            'keterangan' => $this->faker->sentence(),
        ];
    }
}

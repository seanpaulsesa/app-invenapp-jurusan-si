<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class KategoriBarangSeeder extends Seeder
{
    public function run()
    {
        KategoriBarang::factory()->count(15)->create();
    }
}

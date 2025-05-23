<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Ketua Jurusan',
            'email' => 'ketua.jurusan@mail.com',
            'password' => Hash::make('ketua.jurusan@mail.com'),
            'profile_photo_path' => 'image/avatar-man-5.png',
            'role' => 'pimpinan',
        ]);
        
        User::factory()->create([
            'name' => 'Admin Jurusan',
            'email' => 'admin.jurusan@mail.com',
            'password' => Hash::make('admin.jurusan@mail.com'),
            'profile_photo_path' => 'image/avatar-man-5.png',
            'role' => 'admin',
        ]);

        
        // \App\Models\Barang::factory(10)->create();
        // \App\Models\Ruangan::factory(10)->create();

        
        $this->call([

            KategoriBarangSeeder::class,
            BarangSeeder::class,
            KategoriRuanganSeeder::class,
            RuanganSeeder::class,

        ]);

    }
}

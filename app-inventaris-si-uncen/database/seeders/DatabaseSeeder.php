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
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test@example.com'),
            'profile_photo_path' => 'image/avatar-man-5.png',
        ]);

        User::factory()->create([
            'name' => 'Admin Master',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin@example.com'),
            'profile_photo_path' => 'image/avatar-man-5.png',
        ]);

        
        // \App\Models\Barang::factory(10)->create();
        // \App\Models\Ruangan::factory(10)->create();

        
        $this->call([

            KategoriBarangSeeder::class,
            BarangSeeder::class,

        ]);

    }
}

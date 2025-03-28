<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('test@example.com'),
            'profile_photo_path' => 'https://avatar.iran.liara.run/public/28',
        ]);

        User::factory()->create([
            'name' => 'Paulus Sesa',
            'email' => 'p.sesa@mail.com',
            'password' => bcrypt('p.sesa@mail.com'),
            'profile_photo_path' => 'https://avatar.iran.liara.run/public/46',
        ]);

        
        \App\Models\Barang::factory(10)->create();

    }
}

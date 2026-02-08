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
        // Create Super Admin
        User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@desa.id',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Web Admin
        User::factory()->create([
            'name' => 'Operator Web',
            'email' => 'web@desa.id',
            'password' => bcrypt('password'),
            'role' => 'web_admin',
        ]);

        // Create 50 Dummy Residents
        \App\Models\Resident::factory(50)->create();
        
        // Create 10 dummy letters
        // \App\Models\Letter::factory(10)->create(); 
    }
}

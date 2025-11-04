<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Membuat user admin default
        User::create([
            'name' => 'Admin PN Klaten',
            'email' => '2200018335@webmail.uad.ac.id', // Ganti dengan email admin yang Anda inginkan
            'password' => Hash::make('password123'), // Ganti dengan password yang kuat
            'role' => 'admin', // ROLE PENTING UNTUK MENGAKSES DASHBOARD ADMIN
        ]);
    }
}

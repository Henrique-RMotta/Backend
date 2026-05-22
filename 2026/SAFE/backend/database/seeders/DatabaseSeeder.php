<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Analista AQV',
            'email' => 'aqv@safe.com',
            'password' => bcrypt('password'),
            'role' => 'aqv',
        ]);

        User::factory()->create([
            'name' => 'Portaria',
            'email' => 'portaria@safe.com',
            'password' => bcrypt('password'),
            'role' => 'portaria',
        ]);

        User::factory()->create([
            'name' => 'Professor',
            'email' => 'professor@safe.com',
            'password' => bcrypt('password'),
            'role' => 'professor',
        ]);
    }
}

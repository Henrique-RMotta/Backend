<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pokedex;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Pokedex::factory()->create([
            'POKE_name'       => 'Infernus',
            'POKE_elements'   => ['Fogo', 'Dragão'],
            'POKE_height'     => 2.10,
            'POKE_weight'     => 150.0,
            'POKE_stats'      => [
                'hp'      => 90,
                'attack'  => 130,
                'defense' => 90,
                'spatk'   => 110,
                'spdef'   => 100,
                'speed'   => 95,
            ],
            'POKE_generation' => 'Geração Especial',
            'POKE_abilities'  => ['Corpo de Chamas'],
            'POKE_xp'         => 800,
            'POKE_sprite'     => 'pokemons/exemplo_normal.png', // Caminho em storage/app/public/
            'POKE_shiny'      => 'pokemons/exemplo_shiny.png',  // Caminho em storage/app/public/
            'POKE_audio'      => 'cries/exemplo_audio.mp3',     // Caminho em storage/app/public/
        ]);
    }
}

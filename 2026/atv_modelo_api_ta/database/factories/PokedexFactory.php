<?php

namespace Database\Factories;

use App\Models\Pokedex;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pokedex>
 */
class PokedexFactory extends Factory
{
    protected $model = Pokedex::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'POKE_name'       => fake()->unique()->firstName() . 'mon',
            'POKE_elements'   => fake()->randomElements(['Fogo', 'Água', 'Planta', 'Elétrico', 'Gelo', 'Lutador', 'Veneno'], rand(1, 2)),
            'POKE_height'     => fake()->randomFloat(2, 0.3, 3.0),
            'POKE_weight'     => fake()->randomFloat(2, 1.0, 200.0),
            'POKE_stats'      => [
                'hp'      => fake()->numberBetween(10, 255),
                'attack'  => fake()->numberBetween(10, 255),
                'defense' => fake()->numberBetween(10, 255),
                'spatk'   => fake()->numberBetween(10, 255),
                'spdef'   => fake()->numberBetween(10, 255),
                'speed'   => fake()->numberBetween(10, 255),
            ],  
            'POKE_generation' => 'Geração ' . fake()->randomElement(['I', 'II', 'III', 'IV']),
            
            'POKE_sprite'     => null, 
            'POKE_shiny'      => null,
            
            'POKE_abilities'  => fake()->randomElements(['Pressão', 'Intimidação', 'Levitar', 'Corpo Puro'], rand(1, 2)),
            
            'POKE_audio'      => null,
            'POKE_xp'         => fake()->numberBetween(50, 1000),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "PR_nome" => fake()->name(),
            "PR_descricao" => fake()->text(),
            "PR_preco" => fake()->numberBetween(1,1000),
        ];
    }
}

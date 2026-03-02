<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedor>
 */
class FornecedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "FOR_nome" => fake()->company(),
            "FOR_CPF" => fake()->unique()->text(),
            "FOR_telefone" => fake()->unique()->phoneNumber(),
            "FOR_endereco" => fake()->unique()->streetAddress(),
        ];
    }
}
